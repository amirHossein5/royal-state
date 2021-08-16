<?php

namespace App\Services;

use App\Models\Advertise;

class AdvertiseService
{
    public function store(array $request): Advertise
    {
        $request['image'] = ImageService::save($request['image'], 'advertises', ['350_250', '730_400']);

        return Advertise::create($request);
    }

    public function update(array $request,Advertise $advertise): Bool
    {
        if (in_array('image', array_keys($request))) {
            $request['image'] = ImageService::save($request['image'], 'advertises', ['350_250', '730_400']);
        }

        return $advertise->update($request);
    }
}
