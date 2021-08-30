<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Services\PermissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermissionController extends Controller
{
    public function editUserPermissions(User $user): View
    {
        $permissions = $user->permissions
            ->mapWithKeys(fn ($item) => [$item->name => $item->name]);

        return view('dashbord.users.permissions.edit', compact('permissions', 'user'));
    }

    public function updateUserPermissions(PermissionRequest $request, User $user): RedirectResponse
    {
        $permissions = (new PermissionService)
            ->getPermissionsFrom($request->permissions);

        $permissions = !$permissions ? [] : Permission::whereIn('name', $permissions)->pluck('id');

        $user->permissions()->sync($permissions);

        return redirect()
            ->route('dashboard.users.index')
            ->with('success', 'با موفقیت تغییر یافت');
    }

    public function editRolesPermissions(Role $role): View
    {
        $permissions = $role->permissions
            ->mapWithKeys(fn ($item) => [$item->name => $item->name]);

        return view('dashbord.roles.permissions.edit', compact('permissions', 'role'));
    }

    public function updateRolesPermissions(PermissionRequest $request, Role $role): RedirectResponse
    {
        $permissions = (new PermissionService)
            ->getPermissionsFrom($request->permissions);

        $permissions = !$permissions ? [] : Permission::whereIn('name', $permissions)->pluck('id');

        if ($role->id === User::ADMIN_ROLE) {
            return redirect()
                ->route('dashboard.roles.index')
                ->with('failed', 'ادمین همه دسترسی هارا دارد');
        }

        $role->permissions()->sync($permissions);

        return redirect()
            ->route('dashboard.roles.index')
            ->with('success', 'با موفقیت تغییر یافت');
    }
}
