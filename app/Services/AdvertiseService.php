<?php

namespace App\Services;

use App\Models\Advertise;

class AdvertiseService
{
    public function store(array $request): Advertise
    {
        $request['image'] = $this->saveImage($request['image']);

        return Advertise::create($request);
    }

    public function update(array $request, Advertise $advertise): Bool
    {
        if (in_array('image', array_keys($request))) {
            ImageService::remove($advertise->image);

            $request['image'] = $this->saveImage($request['image']);
        }

        return $advertise->update($request);
    }

    private function saveImage(object $image): array
    {
        return ImageService::make($image)
            ->folder('advertises1')
            ->sizes(['350_250', '730_400'])
            ->save();
    }
}
