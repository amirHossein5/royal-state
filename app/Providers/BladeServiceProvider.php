<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('isAdmin', function () {
            return "<?php if(auth()->user()->id === App\Models\User::ADMIN_ROLE) { ?>";
        });

        Blade::directive('endIsAdmin', function () {
            return "<?php } ?>";
        });

    }
}
