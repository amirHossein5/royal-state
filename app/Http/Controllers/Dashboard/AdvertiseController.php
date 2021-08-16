<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Models\Advertise;
use App\Services\AdvertiseService;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertiseRequest;
use App\Services\CategoryService;
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

        return view('dashbord.ads.index', compact('ads'));
    }

    public function create()
    {
        $categories = (new CategoryService)->getAll();

        return view('dashbord.ads.create', compact('categories'));
    }

    public function store(AdvertiseRequest $request): RedirectResponse
    {
        (new AdvertiseService)->store($request->validated());

        return redirect()
            ->route('dashboard.advertises.index')
            ->with('success', 'با موفقیت ساخته شد');
    }

    public function edit(Advertise $advertise)
    {
        $categories = Category::whereNull('parent_id')
            ->get(['id', 'name']);

        return view('dashbord.ads.edit', compact('categories', 'advertise'));
    }

    public function update(AdvertiseRequest $request, Advertise $advertise): RedirectResponse
    {
        (new AdvertiseService)
            ->update($request->validated(), $advertise);

        return redirect()
            ->route('dashboard.advertises.index')
            ->with('success', 'با موفقیت آپدیت شد');
    }

    public function destroy(Advertise $advertise): RedirectResponse
    {
        $advertise->delete();

        return back()
            ->with('success', 'با موفقیت پاک شد');
    }


    public function forceDelete(int $id): RedirectResponse
    {
        Advertise::withTrashed()
            ->where('id', $id)
            ->forceDelete();

        return back()->with('success', 'با موفقیت پاک شد.');
    }

    public function restore(int $id): RedirectResponse
    {
        Advertise::withTrashed()
            ->where('id', $id)
            ->restore();

        return back()->with('success', 'با موفقیت باز گردانده شد.');
    }
}
