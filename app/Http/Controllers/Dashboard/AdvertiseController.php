<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Advertise;
use App\Services\AdvertiseService;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertiseRequest;
use App\Services\CategoryService;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdvertiseController extends Controller
{
    public function index(): View
    {
        $ads = Advertise::withOwner()
            ->withCategory()
            ->withTrashed()
            ->latest()
            ->paginate(10);

        return view('dashbord.advertises.index', compact('ads'));
    }

    public function create(): View
    {
        $this->authorize('create', Advertise::class);

        $categories = (new CategoryService)->getAll();

        return view('dashbord.advertises.create', compact('categories'));
    }

    public function store(AdvertiseRequest $request): RedirectResponse
    {
        $this->authorize('create', Advertise::class);

        (new AdvertiseService)->store($request->validated());

        return redirect()
            ->route('dashboard.advertises.index')
            ->with('success', 'با موفقیت ساخته شد');
    }

    public function edit(Advertise $advertise)
    {
        $this->authorize('update', $advertise);

        $categories = (new CategoryService)->getAll();

        return view('dashbord.advertises.edit', compact('categories', 'advertise'));
    }

    public function update(AdvertiseRequest $request, Advertise $advertise): RedirectResponse
    {
        $this->authorize('update', $advertise);

        (new AdvertiseService)
            ->update($request->validated(), $advertise);

        return redirect()
            ->route('dashboard.advertises.index')
            ->with('success', 'با موفقیت آپدیت شد');
    }

    public function destroy(Advertise $advertise): RedirectResponse
    {
        $this->authorize('delete', $advertise);

        $advertise->delete();

        return back()
            ->with('success', 'با موفقیت پاک شد');
    }

    public function forceDelete(int $id): RedirectResponse
    {
        $advertise = Advertise::withTrashed()
            ->where('id', $id)
            ->first();

        $this->authorize('forceDelete', $advertise);

        ImageService::remove($advertise->image);

        $advertise->forceDelete();

        return back()->with('success', 'با موفقیت پاک شد.');
    }

    public function restore(int $id): RedirectResponse
    {
        $advertise = Advertise::withTrashed()
            ->where('id', $id)
            ->first();

        $this->authorize('restore', $advertise);

        $advertise->restore();

        return back()->with('success', 'با موفقیت باز گردانده شد.');
    }
}
