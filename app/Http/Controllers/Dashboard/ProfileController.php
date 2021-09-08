<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(User $user): View
    {
        return view('dashbord.profile.edit', compact('user'));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = User::where('id', $request->id)->first();

        $request = $request->validated();

        if ($request['email'] !== $user->email) {
            $request['email_verified_at'] = null;
        }

        $user->update($request);

        return redirect()
            ->route('dashboard.profile.edit', $user->first_name)
            ->with('success', 'با موفقیت تغییر یافت');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'exists:users,email'
        ]);

        Auth::logout();

        User::where('email', $request->email)
            ->delete();

        return redirect()
            ->route('app.index');
    }

    public function resetPassword(ResetPasswordRequest $request, User $user): RedirectResponse
    {
        $user->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()
            ->route('dashboard.profile.edit', $user->first_name)
            ->with('success', 'با موفقیت تغییر یافت');
    }
}
