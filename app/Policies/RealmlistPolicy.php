<?php

namespace App\Policies;

use App\Realmlist;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RealmlistPolicy
{
    use HandlesAuthorization;

    public function download(?User $user, Realmlist $realmlist)
    {
        return true;
    }
}
