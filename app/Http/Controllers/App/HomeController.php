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
        $sliders = DB::table('slides')->select('advertises.*')
            ->join('advertises', 'advertises.id', 'slides.advertise_id')
            ->orderByDesc('slides.created_at')
            ->get();

        $latestAdvertises = Advertise::latest()->take(10)->get();

        $bestAdvertises = $sliders;

        $interstingFacts = [];
        $interstingFacts['area'] = Advertise::sum('area');
        $interstingFacts['advertise_count'] = Advertise::count();
        $interstingFacts['sellers'] = User::whereHas('advertises')->count();

        $latestBlogs = Post::withCount('comments')
            ->with('author:id,name')
            ->where('published_at', '>=', now())
            ->latest()
            ->take(10)
            ->get();

        // $latestBlogs->each(function($item){
        //     $item->created_at
        // });

        return view(
            'app.index',
            compact(
                'sliders',
                'latestAdvertises',
                'bestAdvertises',
                'interstingFacts',
                'latestBlogs'
            )
        );
    }

    public function about(): View
    {
        $setting = Setting::first('long_description');

        return view('app.about',compact('setting'));
    }
}
