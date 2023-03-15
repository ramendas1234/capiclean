<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use App\Scopes\LatestScope;
use App\Scopes\DeletedAdminScope;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogPost extends Model
{

    use SoftDeletes;
    protected $fillable = ['title', 'content', 'user_id'];
    use HasFactory;

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }


    /*  This function is for local query scope */ 
    public function scopeRamen(Builder $query)
    {
        $query->withCount('comments')->with('user')->with('tags')->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeRichard(Builder $query)
    {
        $query->where('user_id', 8);
    }

    public function scopeMostComment(Builder $query)
    {
        $query->withCount('comments')->orderBy('comments_count', 'desc');
    }


    public static function boot()
    {

        static::addGlobalScope(new DeletedAdminScope) ;
        parent::boot();

        // below line is global scopes
        //static::addGlobalScope(new LatestScope);

        static::deleting(function( BlogPost $blogPost ){
            $blogPost->comments()->delete();
            Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
        });

        static::updating(function( BlogPost $blogPost ){
            Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
        });

        static::restoring(function( BlogPost $blogPost ){
            $blogPost->comments()->restore();
        });
    }
}
