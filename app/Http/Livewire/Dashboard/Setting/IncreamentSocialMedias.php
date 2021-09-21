<?php

namespace App\Http\Livewire\Dashboard\Setting;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\View\View;
use Livewire\Component;

class IncreamentSocialMedias extends Component
{
    public array $social_medias = [];

    protected function rules(): array
    {
        return [
            'social_medias.*.url' => 'required_with:social_medias.*.logo|url',
            'social_medias.*.logo' => 'required_with:social_medias.*.url|string'
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'social_medias.*.url' => __('url'),
            'social_medias.*.logo' => __('logo')
        ];
    }

    public function mount()
    {
        if (auth()->user()->role_id !== User::ADMIN_ROLE) {
            abort(403);
        }
    }

    public function addSocial(): Void
    {
        $this->validate();

        $this->social_medias[] = [
            'url' => '',
            'logo' => 'twitter'
        ];
    }

    public function removeSocial(): Void
    {
        unset($this->social_medias[array_key_last($this->social_medias)]);
    }

    public function save(): Void
    {
        $this->validate();
        
        $setting = Setting::firstOr(function () {
            Setting::create(['social_medias' => $this->social_medias]);
        });

        $setting->social_medias = $this->social_medias;
        $setting->update();

        $this->emitSelf('updated');
    }

    public function render(): View
    {
        return view('livewire.dashboard.setting.increament-social-medias');
    }
}
