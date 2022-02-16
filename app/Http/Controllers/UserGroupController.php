<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserGroupRequest;
use App\Http\Requests\UpdateUserGroupRequest;
use App\Models\UserGroup;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(StoreUserGroupRequest $request)
    {
        $userGroup = UserGroup::create($request->all());
        return ["data" => "success",
            "result"=>$userGroup];
    }

}
