<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->withTrashed()
            ->withParent()
            ->latest()
            ->whereId()
            ->get();

        return $categories;
    }
}
