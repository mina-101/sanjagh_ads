<?php

namespace App\Listeners;

use App\Events\CampaignHasBeenActivatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use \App\Models\Ad;
use \App\Models\Campaign;
use Illuminate\Support\Facades\Log;
class ActivateAdsListener
{

    /**
     * Handle the event.
     *
     * @param  \App\Events\CampaignHasBeenActivatedEvent  $event
     * @return void
     */
    public function handle(CampaignHasBeenActivatedEvent $event)
    {
        $ads = Ad::where("campaign_id", $event->campaign->id);
        $ads->update(['isActive'=>true]);
    }
}
