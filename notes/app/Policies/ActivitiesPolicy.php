<?php

namespace App\Policies;

use App\Models\Activities;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ActivitiesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 1;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Activities $activities): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Activities $activities): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Activities $activities): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Activities $activities): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Activities $activities): bool
    {
        return true;
    }
}
