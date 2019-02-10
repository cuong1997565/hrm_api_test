<?php

namespace App\Policies;

use App\User;
use App\Repositories\Plans\Plan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the _user.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\User  $_user
     * @return mixed
     */
    public function view(User $user, Plan $plan = null)
    {
        return $user->hasAccess(['plan.view']);
    }

    /**
     * Determine whether the user can create _user.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['plan.create']);
    }

    /**
     * Determine whether the user can update the _user.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\User  $_user
     * @return mixed
     */
    public function update(User $user, Plan $plan = null)
    {
        return $user->hasAccess(['plan.update']);
    }

    /**
     * Determine whether the user can delete the _user.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\User  $_user
     * @return mixed
     */
    public function delete(User $user, Plan $plan = null)
    {
        return $user->hasAccess(['plan.delete']);
    }

    /**
     * Determine whether the user can approve the New plan.
     * @param  User      $user [description]
     * @param  Plan|null $plan [description]
     * @return [type]          [description]
     */
    public function approve(User $user, Plan $plan = null)
    {
        return $user->hasAccess(['plan.approve']);
    }

}
