<?php

namespace App\Providers;

use App\Http\ViewComposers\ActivityComposer;
use App\View\Components\Alert;
use App\View\Components\SidebarCard;
use App\View\Components\Tag;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        Blade::component('alert', Alert::class);
        Blade::component('components.badge', 'badge');
        Blade::component('components.updated', 'updated');

        Blade::component('sidebarCard', SidebarCard::class);
        Blade::component('tag', Tag::class);
        
        view()->composer(['posts.index','posts.single-post'], ActivityComposer::class);
    }
}
