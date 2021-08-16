<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Advertise;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashbord.index');
    }
}
