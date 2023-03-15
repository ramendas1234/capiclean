<?php

namespace App\Models;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['path', 'blog_post_id'];

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }

    public function url()
    {
        return Storage::url($this->path) ;
    }
}