<?php

namespace App\Providers;

use App\Models\Advertise;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Setting;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;


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
            $view->with('site_name', Setting::first('site_name')?->site_name);
        });

        view()->composer(['*.head-tag'],function(View $view){
            $view->with('logo', Setting::first('logo')->logo ?? '');
        });

        view()->composer(['app.layouts.partials.footer'], function (View $view) {
            $setting = Setting::first();

            $view->with('short_description', $setting?->short_description);
            $view->with('site_name', $setting?->site_name);
            $view->with('social_medias', $setting?->social_medias ?? []);
            $view->with('address', $setting?->address);
            $view->with('phone', $setting?->phone);
            $view->with('email', $setting?->email);
        });

        view()->composer(['app.layouts.partials.categories'], function (View $view) {

            $categoryService = new CategoryService;

            if (request()->routeIs('app.advertises.show')) {

                $categoryNames = $categoryService->getRelatedNameByTable('posts');
            } elseif (request()->routeIs('app.posts.show')) {

                $categoryNames = $categoryService->getRelatedNameByTable('advertises');
            }

            $categoriesWithCount = $categoryService->countNames($categoryNames);

            $view->with('categories', $categoriesWithCount);
        });
    }
}
