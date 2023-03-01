<?php

namespace App\Providers;

use App\Policies\BlogPostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
         'App\Models\BlogPost' => 'App\Policies\BlogPostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('home.secret', function($user){
            return $user->is_admin ;
        });
        // Gate::define('update-post', function ($user, $post){
        //     return $user->id === $post->user_id ;
        // });

        // Gate::define('delete-post', function ($user, $post){
        //     return $user->id === $post->user_id ;
        // });

        // Gate::define('posts.update', [BlogPostPolicy::class , 'update']);
        // Gate::define('posts.delete', [BlogPostPolicy::class , 'delete']);

        Gate::before(function( $user, $ability ){
            if($user->is_admin && in_array($ability, ['update', 'delete']) ){
                return true ;
            }
        });
    }
}
