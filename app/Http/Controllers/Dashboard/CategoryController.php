<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()
            ->withTrashed()
            ->latest()
            ->paginate(5);

        return view('dashbord.categories.index', compact('categories'));
    }

    public function create(): View
    {
        $this->authorize('create', Category::class);

        return view('dashbord.categories.create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $this->authorize('create', Category::class);

        Category::create($request->validated());

        return redirect()
            ->route('dashboard.categories.index')
            ->with('success', 'با موفقیت ساخته شد.');
    }

    public function edit(Category $category): view
    {
        $this->authorize('update', $category);

        return view('dashbord.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $this->authorize('update', $category);

        $category->update($request->validated());

        return redirect()
            ->route('dashboard.categories.index')
            ->with('success', 'با موفقیت بروزرسانی شد.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->authorize('delete', $category);

        $category->delete();

        return back()
            ->with('success', 'با موفقیت پاک شد.');
    }

    public function forceDelete(int $id): RedirectResponse
    {
        $this->authorize('forceDelete', Category::class);

        Category::withTrashed()
            ->where('id', $id)
            ->forceDelete();

        return back()
            ->with('success', 'با موفقیت پاک شد.');
    }

    public function restore(int $id): RedirectResponse
    {
        $this->authorize('restore', Category::class);

        Category::withTrashed()
            ->where('id', $id)
            ->restore();

        return back()
            ->with('success', 'با موفقیت باز گردانده شد.');
    }
}
