<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Setting;
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
            $view->with('user', auth()->user());
        });

        view()->composer(['app.layouts.partials.nav-bar'], function (View $view) {
            $view->with('menus', Menu::all());
        });

        view()->composer(['app.layouts.partials.footer'], function (View $view) {
            $setting = Setting::first();

            $view->with('short_description', $setting->short_description);
            $view->with('site_name', $setting->site_name);
            $view->with('social_medias', $setting->social_medias);
            $view->with('address', $setting->address);
            $view->with('phone', $setting->phone);
            $view->with('email', $setting->email);
        });

        view()->composer(['app.layouts.partials.categories'], function (View $view) {
            $categories = '';

            if(request()->is('advertises/*')){

            }

            $view->with('categories', $categories);
        });
    }
}
