<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['dashbord.layouts.partials.header'], function (View $view) {
            $view->with('user',auth()->user());
        });

        view()->composer(['app.layouts.partials.nav-bar'], function (View $view) {
            $view->with('menus', Menu::all());
        });
    }
}
