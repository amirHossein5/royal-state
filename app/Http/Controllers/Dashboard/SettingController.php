<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingUpdateRequest;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        $setting = Setting::first();

        return view('dashbord.settings.edit', compact('setting'));
    }

    public function update(SettingUpdateRequest $request): RedirectResponse
    {
        $request = $request->validated();

        if (array_key_exists('logo', $request)) {
            $request['logo'] = $this->processLogo($request);
        }

        Setting::createOrUpdate($request);

        return redirect()
            ->route('dashboard.settings.edit')
            ->with('success', 'باموفقیت تغییر کرد');
    }

    private function processLogo(array $request): string
    {
        $files = Storage::allFiles('public/images/settings');
        Storage::delete($files);

        return str_replace(
            'public',
            'storage',
            Storage::put('public/images/settings', $request['logo'])
        );
    }
}
