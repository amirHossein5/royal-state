<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class SlideController extends Controller
{
    public function index()
    {
        return view('dashbord.slide.index');
    }

    public function create()
    {
        return view('dashbord.slide.create');
    }
}
