<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Advertise;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvertisePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission('advertise_view_any');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Advertise  $advertise
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Advertise $advertise)
    {
        return $user->hasPermission('advertise_view') && $user->hasAdvertise($advertise->id);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('advertise_create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Advertise  $advertise
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Advertise $advertise)
    {
        return $user->hasPermission('advertise_update') && $user->hasAdvertise($advertise->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Advertise  $advertise
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Advertise $advertise)
    {
        return $user->hasPermission('advertise_delete') && $user->hasAdvertise($advertise->id);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Advertise  $advertise
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Advertise $advertise)
    {
        return $user->hasPermission('advertise_restore') && $user->hasAdvertise($advertise->id);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Advertise  $advertise
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Advertise $advertise)
    {
        return $user->hasPermission('advertise_force_delete') && $user->hasAdvertise($advertise->id);
    }
}
