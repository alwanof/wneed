<?php

namespace App\Policies;

use App\Driver;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\HandlesAuthorization;

class DriverPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return Gate::any(['viewDriver'], $user);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Driver  $driver
     * @return mixed
     */
    public function view(User $user, Driver $driver)
    {
        return Gate::any(['viewDriver', 'manageDriver'], $user, $driver);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return Gate::any(['manageDriver'], $user);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Driver  $driver
     * @return mixed
     */
    public function update(User $user, Driver $driver)
    {
        return Gate::any(['manageDriver'], $user, $driver);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Driver  $driver
     * @return mixed
     */
    public function delete(User $user, Driver $driver)
    {
        return Gate::any(['manageDriver'], $user, $driver);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Driver  $driver
     * @return mixed
     */
    public function restore(User $user, Driver $driver)
    {
        return Gate::any(['manageDriver'], $user, $driver);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Driver  $driver
     * @return mixed
     */
    public function forceDelete(User $user, Driver $driver)
    {
        return Gate::any(['manageDriver'], $user, $driver);
    }
}
