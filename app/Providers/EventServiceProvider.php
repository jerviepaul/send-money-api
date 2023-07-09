<?php

namespace App\Providers;

use App\Events\SuccessfulLogin;
use App\Events\SuccessfulLogout;
use App\Events\SuccessfulRegistration;
use App\Events\SuccessfulUserTransfer;
use App\Listeners\CreateAccountAfterRegistration;
use App\Listeners\LogSuccessfulLogin;
use App\Listeners\LogSuccessfulLogout;
use App\Listeners\LogSuccessfulUserTransfer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Event::listen(
            SuccessfulLogin::class,
            [LogSuccessfulLogin::class, 'handle']
        );

        Event::listen(
            SuccessfulLogout::class,
            [LogSuccessfulLogout::class, 'handle']
        );
        
        Event::listen(
            SuccessfulRegistration::class,
            [CreateAccountAfterRegistration::class, 'handle']
        );

        Event::listen(
            SuccessfulUserTransfer::class,
            [LogSuccessfulUserTransfer::class, 'handle']
        );

    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}