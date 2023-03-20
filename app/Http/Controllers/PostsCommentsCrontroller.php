<?php

namespace App\Http\Controllers;
use App\Models\Comment;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Http\Requests\StoreComment;
use Illuminate\Support\Facades\Auth;

class PostsCommentsCrontroller extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComment $request, $id)
    {
        //
        
        $blog_post = BlogPost::findOrFail($id);
        $blog_post->comments()->create([
            'content'=> $request->input('content'),
            'user_id' => $request->user()->id
        ]);
        /*$comment = new Comment();
        $comment->content = $request->get('content');
        $comment->blogPost()->associate($blog_post);
        $comment->user()->associate(Auth::user());
        $comment->save();*/


        $request->session()->flash('status', 'Comment was created!');
        
        
        //return redirect()->route('posts.show',['post'=>$id]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
