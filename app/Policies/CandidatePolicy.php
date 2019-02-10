<?php

namespace App\Policies;

use App\User;
use App\Repositories\Candidates\Candidate;
use Illuminate\Auth\Access\HandlesAuthorization;

class CandidatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the _user.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\User  $_user
     * @return mixed
     */
    public function view(User $user, Candidate $candidate = null)
    {
        return $user->hasAccess(['candidate.view']);
    }

    /**
     * Determine whether the user can create _user.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['candidate.create']);
    }

    /**
     * Determine whether the user can update the _user.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\User  $_user
     * @return mixed
     */
    public function update(User $user, Candidate $candidate = null)
    {
        return $user->hasAccess(['candidate.update']);
    }

    /**
     * Determine whether the user can delete the _user.
     *
     * @param  \App\User  $user
     * @param  \App\Repositories\Categories\User  $_user
     * @return mixed
     */
    public function delete(User $user, Candidate $candidate = null)
    {
        return $user->hasAccess(['candidate.delete']);
    }
}
