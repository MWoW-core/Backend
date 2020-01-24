<?php

namespace App\Policies;

use App\Process;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeploymentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any deployments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the deployment.
     *
     * @param  \App\User  $user
     * @param  \App\Process  $deployment
     * @return mixed
     */
    public function view(User $user, Process $deployment)
    {
        //
    }

    /**
     * Determine whether the user can create deployments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the deployment.
     *
     * @param  \App\User  $user
     * @param  \App\Process  $deployment
     * @return mixed
     */
    public function update(User $user, Process $deployment)
    {
        //
    }

    /**
     * Determine whether the user can delete the deployment.
     *
     * @param  \App\User  $user
     * @param  \App\Process  $deployment
     * @return mixed
     */
    public function delete(User $user, Process $deployment)
    {
        //
    }

    /**
     * Determine whether the user can restore the deployment.
     *
     * @param  \App\User  $user
     * @param  \App\Process  $deployment
     * @return mixed
     */
    public function restore(User $user, Process $deployment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the deployment.
     *
     * @param  \App\User  $user
     * @param  \App\Process  $deployment
     * @return mixed
     */
    public function forceDelete(User $user, Process $deployment)
    {
        //
    }
}
