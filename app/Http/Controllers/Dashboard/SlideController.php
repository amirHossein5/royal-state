<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SlideStoreRequest;
use App\Models\Advertise;
use App\Models\Slide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SlideController extends Controller
{
    public function index(): View
    {
        $slides = Slide::with('advertise')->paginate(10);

        return view('dashbord.slides.index', compact('slides'));
    }

    public function create(): View
    {
        $this->authorize('create', Slide::class);

        $advertises = DB::table('advertises')
            ->whereNull('deleted_at')
            ->get(['title', 'id']);

        return view('dashbord.slides.create', compact('advertises'));
    }

    public function store(SlideStoreRequest $requests): RedirectResponse
    {
        $this->authorize('create', Slide::class);

        Advertise::find($requests->advertise_id)->slide()->create();

        return redirect()
            ->route('dashboard.slides.index')
            ->with('success', 'با موفقیت ساخته شد');
    }

    public function destroy(Slide $slide): RedirectResponse
    {
        $this->authorize('delete', Slide::class);

        $slide->delete();

        return back()
            ->with('success', 'با موفقیت پاک شد');
    }
}
