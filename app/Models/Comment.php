<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
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
    
    }


}
