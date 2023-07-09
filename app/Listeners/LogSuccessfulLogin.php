<?php

namespace App\Listeners;

use App\Events\SuccessfulLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use DateTime;
use OwenIt\Auditing\Models\Audit;

class LogSuccessfulLogin
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
    public function handle(SuccessfulLogin $event): void
    {
        $data = [
            'auditable_id' => $event->user->id,
            'auditable_type' => 'logged in',
            'event' => 'logged in',
            'url' => request()->fullUrl(),
            'ip_address' => request()->getClientIp(),
            'user_agent' => request()->userAgent(),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'user_id' => $event->user->id,
        ];

        Audit::create($data);
    }
}
