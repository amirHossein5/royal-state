<?php

namespace App\Observers;

use App\Models\Advertise;
use Illuminate\Support\Facades\Auth;

class AdvertiseObserver
{
    /**
     * Handle the Advertise "creating" event.
     *
     * @param  \App\Models\Advertise  $advertise
     * @return void
     */
    public function creating(Advertise $advertise)
    {
        $advertise['user_id'] = Auth::user()->id;
    }

    /**
     * Handle the Advertise "created" event.
     *
     * @param  \App\Models\Advertise  $advertise
     * @return void
     */
    public function created(Advertise $advertise)
    {
        //
    }

    /**
     * Handle the Advertise "updated" event.
     *
     * @param  \App\Models\Advertise  $advertise
     * @return void
     */
    public function updated(Advertise $advertise)
    {
        //
    }

    /**
     * Handle the Advertise "deleted" event.
     *
     * @param  \App\Models\Advertise  $advertise
     * @return void
     */
    public function deleted(Advertise $advertise)
    {
        //
    }

    /**
     * Handle the Advertise "restored" event.
     *
     * @param  \App\Models\Advertise  $advertise
     * @return void
     */
    public function restored(Advertise $advertise)
    {
        //
    }

    /**
     * Handle the Advertise "force deleted" event.
     *
     * @param  \App\Models\Advertise  $advertise
     * @return void
     */
    public function forceDeleted(Advertise $advertise)
    {
        //
    }
}
