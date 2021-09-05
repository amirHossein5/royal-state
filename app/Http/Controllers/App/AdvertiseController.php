<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdvertiseController extends Controller
{
    public function index(): View
    {
        $advertises = Advertise::paginate(9);

        return view('app.advertises.index', compact('advertises'));
    }

    public function show(Advertise $advertise): View
    {
        $latestPosts = Post::withCount('comments')
            ->with('author:id,first_name')
            ->latest()
            ->take(5)
            ->get();

        return view('app.advertises.show', compact('advertise', 'latestPosts'));
    }
}
