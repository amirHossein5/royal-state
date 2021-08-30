<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\Advertise;
use App\Models\Gallery;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function show(Advertise $advertise): View
    {
        $advertise->load('galleries');

        return view('dashbord.advertises.gallery', compact('advertise'));
    }

    public function store(Advertise $advertise, GalleryRequest $request): RedirectResponse
    {
        foreach ($request->images as $image) {
            $image = ImageService::make($image)
                ->folder('galleries')
                ->sizes(['350_250', '730_400'])
                ->save();

            $advertise->galleries()->create([
                'image' => $image
            ]);
        }

        return redirect()
            ->route('dashboard.advertises.gallery.index', $advertise->id)
            ->with('success', 'باموفقیت ساخته شد');
    }

    public function destroy(Advertise $advertise, Gallery $gallery): RedirectResponse
    {
        if ($gallery->advertise_id === $advertise->id) {
            $gallery->delete();
        }

        return back();
    }
}
