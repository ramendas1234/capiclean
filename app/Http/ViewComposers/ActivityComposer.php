<?php
namespace App\Http\ViewComposers;

use App\Models\User;
use App\Models\BlogPost;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class ActivityComposer{

    public function compose(View $view) {
        
        $mostCommentPosts = Cache::tags(['blog-post'])->remember('blog-post-commented', now()->addSeconds(600), function(){
            return BlogPost::mostComment()->take(5)->get() ;
        });

        $mostActiveUsers = Cache::remember('users-most-active', now()->addSeconds(600), function(){
            return User::mostActiveUser()->take(3)->get() ;
        });

        $mostActiveLastMonth = Cache::remember('users-most-active-last-month', now()->addSeconds(600), function(){
            return User::mostBlogPostsLastMonth()->take(3)->get() ;
        });

        $view->with('mostCommentPosts', $mostCommentPosts);
        $view->with('mostActiveUsers', $mostActiveUsers);
        $view->with('mostActiveLastMonth', $mostActiveLastMonth);

    }

}