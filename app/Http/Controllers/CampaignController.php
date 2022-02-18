<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCampaignRequest;
use App\Jobs\ActivateCampaignAdsJob;
use App\Models\Campaign;
use App\Events\CampaignHasBeenActivatedEvent;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::where("user_id", auth()->user()->_id)->get();
        return ["data" => "success",
            "result"=>$campaigns];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCampaignRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCampaignRequest $request)
    {
        $campaign = Campaign::create($request->all());
        return ["data" => "success",
            "result"=>$campaign];
    }

    /**
     * @param Campaign $campaign
     * @return array
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function activate(Campaign $campaign)
    {
        if(!$campaign){
            abort(404, trans('errors.NOT_FOUND_CAMPAIGN'));
        }
        $this->authorize('activate', $campaign);
        $campaign->isActive = true;
        $campaign->save();
        ActivateCampaignAdsJob::dispatch($campaign);
        return ["data" => "success",
            "result"=>$campaign];
    }

    /**
     * @param $search
     * @return array
     */
    public function search($search)
    {
        if (!($search)) {
            abort(400, trans('errors.REQUIRED_FIELD'));
        }
        $campaigns = Campaign::where('user_id', auth()->user()->id)->where(function ($query) use ($search){
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%' . $search . '%');
        })-> get();
        return ["data" => "success",
            "result"=>$campaigns];
    }


}
