<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostTagController extends Controller
{
    //

    /**
     * Display a listing of posts for specific tag .
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tag)
    {
        $tag = Tag::findOrFail($tag);

        return view(
            'posts.index',
            [
                'posts'=> $tag->blogPosts,
                'mostCommentPosts' => [],
                'mostActiveUsers' => [],
                'mostActiveLastMonth' => []
            ]
        );

    }
}
