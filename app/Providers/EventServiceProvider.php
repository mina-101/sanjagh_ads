<?php

namespace App\Providers;

use App\Events\CampaignHasBeenActivatedEvent;
use App\Listeners\ActivateAdsListener;
use App\Jobs\ActivateCampaignAdsJob;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        CampaignHasBeenActivatedEvent::class => [
            ActivateAdsListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            ActivateCampaignAdsJob::class
        );

    }
}
