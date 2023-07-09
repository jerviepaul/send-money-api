<?php

namespace App\Http\Controllers\API;

use App\Events\SuccessfulLogin;
use App\Events\SuccessfulLogout;
use App\Events\SuccessfulRegistration;
use App\Models\API\OauthAccessToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,except,id',
            'password' => 'required|confirmed',
            'bank_id' => 'required|integer',
            'acct_number' => 'required|string|unique:accounts,acct_number,except,id',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());     
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        // Create user Account data.
        SuccessfulRegistration::dispatch($request, $user);

        $success['token'] = $user->createToken(config('app.name'))->accessToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());     
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {

                $userWithAcct = User::where('id', $user->id)
                            ->with('account')
                            ->with('transactions')
                            ->get();

                $success['token'] = $user->createToken($user->email . config('app.name'))->accessToken;
                $success['user'] = $userWithAcct;

                Auth::guard('api')->setUser($user);

                SuccessfulLogin::dispatch($user);
    
                return $this->sendResponse($success, 'User login successfully.');
            } else {
                return $this->sendError('Validation Error.', 'Password is incorrect.');     
            }
        } else {
            return $this->sendError('Validation Error.', 'User not found.');     
        }
    }

    /**
     * Logout api
     * 
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request) {
        $user = Auth::user();
        SuccessfulLogout::dispatch($user);
        $request->user('api')->token()->revoke();
        $request->user('api')->token()->delete();
        return $this->sendResponse([], 'Successfully logged out.');
    }

    /**
     * Unauthorized api
     * 
     * @return \Illuminate\Http\Response
     */
    public function unauthorized(Request $request) 
    {
        return $this->sendError('Unauthorized.', ['error'=>'Unauthorized']);
        // return Redirect::to(env('APP_FE_URL'));
    }
}
