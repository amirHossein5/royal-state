<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = DB::table('roles')->latest()->paginate(10);

        return view('dashbord.roles.index', compact('roles'));
    }

    public function create(): View
    {
        return view('dashbord.roles.create');
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        Role::create($request->all());

        return redirect()
            ->route('dashboard.roles.index')
            ->with('success', 'ساخته شد');
    }

    public function edit(Role $role): View
    {
        return view('dashbord.roles.edit', compact('role'));
    }

    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        $role->update($request->all());

        return redirect()
            ->route('dashboard.roles.index')
            ->with('success', 'با موفقیت ویرایش شد');
    }

    public function delete(Role $role): RedirectResponse
    {
        $role->delete();

        return back()
            ->with('success', 'با موفقیت پاک شد');
    }
}
