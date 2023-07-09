<?php

namespace App\Listeners;

use App\Events\SuccessfulRegistration;
use App\Models\API\Account;
use DateTime;

class CreateAccountAfterRegistration
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
    public function handle(SuccessfulRegistration $event): void
    {
        $data = [
            'acct_number' => $event->request->acct_number,
            'acct_balance' => 0,
            'user_id' => $event->user->id,
            'bank_id' => $event->request->bank_id,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];

        Account::create($data);
    }
}
