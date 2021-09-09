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
        if (request()->has('category')) {
            $advertises = Advertise::whereCategory(request()->category)->paginate(9);
        } elseif (request()->has('address')) {
            $advertises = Advertise::where('address', 'LIKE', "%" . request()->address . "%")->paginate(9);
        } else {
            $advertises = Advertise::paginate(9);
        }

        return view('app.advertises.index', compact('advertises'));
    }

    public function show(Advertise $advertise): View
    {
        $advertise->load('galleries', 'owner');

        $latestBlogs = Post::withCount('comments')
            ->with('author:id,first_name')
            ->latest()
            ->take(5)
            ->get();

        $relatedAdvertises = Advertise::query()
            ->where('cat_id', $advertise->cat_id)
            ->where('id', '!=', $advertise->id)
            ->get();

        return view('app.advertises.show', compact('advertise', 'latestBlogs', 'relatedAdvertises'));
    }
}
