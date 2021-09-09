<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $sliders = Slide::with('advertise')
            ->latest()
            ->get();

        $latestAdvertises = Advertise::latest()->take(10)->get();

        $bestAdvertises = $sliders;

        $interstingFacts = [];
        $interstingFacts['area'] = Advertise::sum('area');
        $interstingFacts['advertise_count'] = Advertise::count();
        $interstingFacts['sellers'] = User::whereHas('advertises')->count();

        $latestBlogs = Post::withCount('comments')
            ->with('author:id,first_name')
            ->where('published_at', '<=', now())
            ->latest()
            ->take(10)
            ->get();

        $site_name = Setting::first('site_name')?->site_name;

        return view(
            'app.index',
            compact(
                'sliders',
                'latestAdvertises',
                'bestAdvertises',
                'interstingFacts',
                'latestBlogs',
                'site_name'
            )
        );
    }

    public function about(): View
    {
        $setting = Setting::first('long_description');

        return view('app.about', compact('setting'));
    }
}
