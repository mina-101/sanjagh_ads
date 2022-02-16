<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdRequest;
use App\Models\Ad;
use App\Models\Campaign;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($campaignId)
    {
        $campaign = Campaign::find($campaignId);
        if(!$campaign){
            abort(404, trans('errors.NOT_FOUND_CAMPAIGN'));
        }
        if($campaign["user_id"] != auth()->user()->_id){
            abort(401, trans('errors.NOT_FOUND_CAMPAIGN'));
        }
        $ads = $campaign->ads;
        return ["data" => "success",
            "result"=>$ads];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdRequest $request, $campaignId)
    {
        $campaign = Campaign::find($campaignId);
        if(!$campaign){
            abort(404, trans('errors.NOT_FOUND_CAMPAIGN'));
        }
        $data = [
            "title"=>$request['title'],
            "content"=>$request['content']
        ];
        $ad = $campaign->ads()->create($data);
        return ["data" => "success",
            "result"=>$ad];
    }


}
