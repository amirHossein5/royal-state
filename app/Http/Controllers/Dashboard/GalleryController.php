<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;

class GalleryController extends Controller
{
    public function show($advertiseId)
    {
        $galleries = Gallery::whereAdvertise($advertiseId)->get();

        return view('dashbord.ads.gallery', compact('galleries'));
    }

    public function store(GalleryRequest $request): RedirectResponse
    {
        Gallery::create($request->validated());

        return redirect()->route('dashboard.advertises.gallery.index', $request['advertise_id'])->with('success', 'باموفقیت ساخته شد');
    }
}
