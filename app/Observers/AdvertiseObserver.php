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
}
