<?php

namespace App\Listeners;

use App\Events\SuccessfulUserTransfer;
use App\Models\API\UserTransaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulUserTransfer
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SuccessfulUserTransfer $event): void
    {
        $data = [
            'user_id' => $event->userTransaction->user_id,
            'previous_balance' => $event->userTransaction->previous_balance,
            'current_balance' => $event->userTransaction->current_balance,
            'transaction_amount' => $event->userTransaction->transaction_amount,
            'type' => $event->userTransaction->type,
            'channel'=> $event->userTransaction->channel,
        ];

        UserTransaction::create($data);
    }
}
