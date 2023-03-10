<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function blogPost()
    {
        return $this->hasMany(BlogPost::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeMostActiveUser(Builder $query){

        return $query->withCount('blogPost')->orderBy('blog_post_count', 'desc');
    }

    public function scopeMostBlogPostsLastMonth(Builder $query){
        
        return $query->withCount(['blogPost' => function($query){
        $query->whereBetween(static::CREATED_AT, [now()->subMonths(1), now()]);
        }])->has('blogPost', '>=', 1)
        ->orderBy('blog_post_count', 'desc');
    }

}
