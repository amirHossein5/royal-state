<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserUpdateRoleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::with('role:id,display_name')
            ->latest()
            ->paginate(10);

        return view('dashbord.users.index', compact('users'));
    }

    public function edit(User $user): View
    {
        $this->authorize('update', $user);

        return view('dashbord.users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $this->authorize('update', $user);

        $user->update($request->validated());

        return redirect()
            ->route('dashboard.users.index')
            ->with('success', 'با موفقیت تغییر یافت');
    }

    public function approved(User $user): RedirectResponse
    {
        $this->authorize('approved', $user);

        $user->approved = !$user->approved;
        $user->save();

        return back()
            ->with('success', 'با موفقیت تغییر یافت');
    }

    public function editUserRole(User $user): View
    {
        $user = $user->load('role:display_name,id');

        $roles = DB::table('roles')->get(['display_name', 'id']);

        return view('dashbord.users.role.edit', compact('roles', 'user'));
    }

    public function updateUserRole(UserUpdateRoleRequest $request, User $user): RedirectResponse
    {
        $user->update(['role_id' => $request->role_id]);

        return redirect()
            ->route('dashboard.users.index')
            ->with('success', 'با موفقیت تغییر یافت');
    }
}
