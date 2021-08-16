<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()
            ->paginate(10);

        return view('dashbord.user.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('dashbord.user.edit',compact('user'));
    }

    public function update(UserRequest $request,User $user): RedirectResponse
    {
        $user->update($request->validated());

        return back()->with('success', 'با موفقیت تغییر یافت');
    }

    public function approved(User $user): RedirectResponse
    {
        $user->approved !=$user->approved;
        $user->save();

        return back()->with('success', 'با موفقیت تغییر یافت');
    }
}
