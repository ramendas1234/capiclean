<?php

namespace App\Models;

use App\Models\User;
use App\Scopes\LatestScope;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['user_id', 'content'];

    /*public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    /*  This function is for local query scope */ 
    // public function scopeLatest(Builder $query)
    // {
    //     $query->orderBy(static::CREATED_AT, 'desc');
    // }
    
    public static function boot()
    {
        parent::boot();

        // below line is for global scopes
        // static::addGlobalScope(new LatestScope);

        static::creating(function (Comment $comment) {

            if ($comment->commentable_type === BlogPost::class) {
                Cache::tags(['blog-post'])->forget("blog-post-{$comment->commentable_id}");
                Cache::tags(['blog-post'])->forget('blog-post-commented');
            }
        });
    
    }


}
