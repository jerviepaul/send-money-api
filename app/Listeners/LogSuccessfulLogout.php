<?php

namespace App\Listeners;

use App\Events\SuccessfulLogout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use OwenIt\Auditing\Models\Audit;
use DateTime;

class LogSuccessfulLogout
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
    public function handle(SuccessfulLogout $event): void
    {
        $data = [
            'auditable_id' => $event->user->id,
            'auditable_type' => 'logged out',
            'event' => 'logged out',
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
