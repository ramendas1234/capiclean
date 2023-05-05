<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\BlogPost;
use App\View\Components\Tag;
use App\View\Components\Alert;
use App\Observers\CommentObserver;
use App\Observers\BlogPostObserver;
use App\View\Components\SidebarCard;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\ActivityComposer;

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
        Blade::component('components.comment-form', 'commentForm');
        Blade::component('components.comment-list', 'commentList');

        Blade::component('sidebarCard', SidebarCard::class);
        Blade::component('tag', Tag::class);
        
        view()->composer(['posts.index','posts.single-post'], ActivityComposer::class);
        BlogPost::observe(BlogPostObserver::class);
        BlogPost::observe(BlogPostObserver::class);
        Comment::observe(CommentObserver::class);
    }
}
