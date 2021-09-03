<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuStoreRequest;
use App\Http\Requests\MenuUpdateRequest;
use App\Models\Menu;
use App\Services\RouteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(): View
    {
        $menus = Menu::withParent()->paginate(5);

        return view('dashbord.menus.index', compact('menus'));
    }

    public function create(): View
    {
        $this->authorize('create', Menu::class);

        $menus = DB::table('menus')
            ->whereNull('parent_id')
            ->get(['name', 'id']);

        $urls = RouteService::routes()
            ->nameStartsWith('app')
            ->method('get')
            ->withoutParameter()
            ->get();

        return view('dashbord.menus.create', compact('menus', 'urls'));
    }

    public function store(MenuStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Menu::class);

        $request =  $request->validated();

        $request['slug'] = make_slug($request['name']);

        Menu::create($request);

        return redirect()
            ->route('dashboard.menus.index')
            ->with('success', 'با موفقیت ساخته شد');
    }

    public function edit(Menu $menu): View
    {
        $this->authorize('update', Menu::class);

        $menu->load('parent');

        $menus = DB::table('menus')
            ->whereNull('parent_id')
            ->where('id', '!=', $menu->id)
            ->get(['name', 'id']);

        $urls = RouteService::routes()
            ->nameStartsWith('app')
            ->method('get')
            ->withoutParameter()
            ->get();

        return view('dashbord.menus.edit', compact('menu', 'menus', 'urls'));
    }

    public function update(MenuUpdateRequest $request): RedirectResponse
    {
        $this->authorize('update', Menu::class);

        Menu::where('id', $request->id)
            ->update($request->validated());

        return redirect()
            ->route('dashboard.menus.index')
            ->with('success', 'با موفقیت ویرایش شد');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->authorize('delete', Menu::class);

        Menu::destroy($id);

        return redirect()
            ->route('dashboard.menus.index')
            ->with('success', 'با موفقیت پاک شد');
    }
}
