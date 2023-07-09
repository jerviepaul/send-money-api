<?php

namespace App\Http\Controllers\API;

use App\Events\SuccessfulUserTransfer;
use App\Http\Controllers\API\BaseController;
use App\Models\API\Account;
use App\Models\API\UserTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserTransactionController extends BaseController
{
    /**
     * User Transfer api
     * 
     * @return \Illuminate\Http\Response
     */
    public function userTransfer(Request $request, UserTransaction $userTransaction) {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'amount' => 'required|decimal:2'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $userTransaction->channel = 'User';

        // Deduct from this user
        if ($this->deductFrom($request->amount, $userTransaction)) {
            if ($this->transferToUser($request, $userTransaction)) {
                $user = Auth::user();
                $userWithAcct = User::where('id', $user->id)
                            ->with('account')
                            ->with('transactions')
                            ->get();
                return $this->sendResponse($userWithAcct, 'Transfer successful.');
            }
        }

        return $this->sendError('Transfer unsuccessful.', 'Transfer error.');
    }

    /**
     * Bank Transfer api
     * 
     * @return \Illuminate\Http\Response
     */
    public function bankTransfer(Request $request, UserTransaction $userTransaction) {
        $validator = Validator::make($request->all(), [
            'provider_id' => 'required',
            'bank_id' => 'required',
            'acct_number' =>'required|numeric',
            'amount' => 'required|decimal:2'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $userTransaction->channel = 'Bank';

        // Deduct from this user
        if ($this->deductFrom($request->amount, $userTransaction)) {
            if ($this->transferToBank($request, $userTransaction)) {
                $user = Auth::user();
                $userWithAcct = User::where('id', $user->id)
                            ->with('account')
                            ->with('transactions')
                            ->get();
                return $this->sendResponse($userWithAcct, 'Transfer successful.');
            }
        }

        return $this->sendError('Transfer unsuccessful.', 'Transfer error.');
    }

    private function deductFrom(float $amount, UserTransaction $userTransaction) : bool {
        $user = Auth::user();
        $userAcct = Account::where('user_id', $user->id)->first();

        if (is_null($userAcct)) {
            return false;
        }

        if ($amount > $userAcct->acct_balance) {
            return false;
        }

        $prevBal = $userAcct->acct_balance;
        $currBal = ($prevBal - $amount);
        $transaction_amount = $amount;

        try {
            $userAcct->acct_balance = $currBal;
            $affectedRows = $userAcct->save();

            if (!$affectedRows) {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }

        $userTransaction->user_id = $user->id;
        $userTransaction->previous_balance = $prevBal;
        $userTransaction->current_balance = $currBal;
        $userTransaction->transaction_amount = $transaction_amount;
        $userTransaction->type = "Send";

        SuccessfulUserTransfer::dispatch($userTransaction);

        return true;
    }

    private function transferToUser(Request $request, UserTransaction $userTransaction) : bool {
        $user = User::where('email', $request->email)->first();
        $userAcct = Account::where('user_id', $user->id)->first();
        
        if (is_null($userAcct)) {
            return false;
        }

        $prevBal = $userAcct->acct_balance;
        $currBal = ($prevBal + $request->amount);
        $transaction_amount = $request->amount;

        try {
            $userAcct->acct_balance = $currBal;
            $affectedRows = $userAcct->save();

            if (!$affectedRows) {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }

        $userTransaction->user_id = $request->user_id;
        $userTransaction->previous_balance = $prevBal;
        $userTransaction->current_balance = $currBal;
        $userTransaction->transaction_amount = $transaction_amount;
        $userTransaction->type = "Receive";

        SuccessfulUserTransfer::dispatch($userTransaction);

        return true;
    }

    private function transferToBank(Request $request, UserTransaction $userTransaction) : bool {
        $userAcct = Account::where('acct_number', $request->acct_number)->first();
        
        if (is_null($userAcct)) {
            return false;
        }

        if ($request->amount > $userAcct->acct_balance) {
            return false;
        }

        $prevBal = $userAcct->acct_balance;
        $currBal = ($prevBal + $request->amount);
        $transaction_amount = $request->amount;

        try {
            $userAcct->acct_balance = $currBal;
            $affectedRows = $userAcct->save();

            if (!$affectedRows) {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }

        $userTransaction->user_id = $userAcct->user_id;
        $userTransaction->previous_balance = $prevBal;
        $userTransaction->current_balance = $currBal;
        $userTransaction->transaction_amount = $transaction_amount;
        $userTransaction->type = "Receive";

        SuccessfulUserTransfer::dispatch($userTransaction);

        return true;
    }
}
