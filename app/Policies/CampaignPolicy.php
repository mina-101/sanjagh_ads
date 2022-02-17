<?php

namespace App\Policies;

use App\Models\Campaign;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class CampaignPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function activate(User $user, Campaign $campaign)
    {
        $userGroup = UserGroup::where("title", "admin")->first();
        return $user->user_group_id === $userGroup['_id'];
    }


}
