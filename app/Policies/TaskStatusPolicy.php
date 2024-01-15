<?php

namespace App\Policies;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskStatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User       $user
     * @param  \App\Models\TaskStatus $taskStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, TaskStatus $taskStatus)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return !Auth::guest();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User       $user
     * @param  \App\Models\TaskStatus $taskStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, TaskStatus $taskStatus)
    {
        return !Auth::guest();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User       $user
     * @param  \App\Models\TaskStatus $taskStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, TaskStatus $taskStatus)
    {
        return $taskStatus->tasks()->doesntExist();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User       $user
     * @param  \App\Models\TaskStatus $taskStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, TaskStatus $taskStatus)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User       $user
     * @param  \App\Models\TaskStatus $taskStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, TaskStatus $taskStatus)
    {
        return false;
    }
}
