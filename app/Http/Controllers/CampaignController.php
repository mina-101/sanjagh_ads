<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCampaignRequest;
use App\Http\Resources\CampaignCollection;
use App\Models\Campaign;

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
     * @param $campaign
     * @return array
     */
    public function activate($campaignId)
    {
        $campaign = Campaign::find($campaignId);
        if(!$campaign){
            abort(404, trans('errors.NOT_FOUND_CAMPAIGN'));
        }
        $campaign->isActive = true;
        $campaign->save();
        return ["data" => "success",
                "result"=>$campaign];
    }


}
