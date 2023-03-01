<?php

namespace App\Models;

use App\Models\Comment;
use App\Scopes\LatestScope;
use App\Scopes\DeletedAdminScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogPost extends Model
{

    use SoftDeletes;
    protected $fillable = ['title', 'content'];
    use HasFactory;

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /*  This function is for local query scope */ 
    public function scopeRamen(Builder $query)
    {
        $query->orderBy(static::CREATED_AT, 'desc');
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
        });

        static::restoring(function( BlogPost $blogPost ){
            $blogPost->comments()->restore();
        });
    }
}
