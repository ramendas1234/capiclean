<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\BlogPost;

use App\Jobs\ThrottledMail;
use App\Mail\CommentPosted;
use Illuminate\Http\Request;
use App\Http\Requests\StoreComment;
use App\Mail\CommentPostedMarkdown;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Jobs\NotifyUsersPostWasCommented;
use App\Http\Resources\Comment as CommentResource;
use App\Events\CommentPosted as EventsCommentPosted;

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
    public function index(BlogPost $post)
    {
        return CommentResource::collection($post->comments);
        //return $post->comments;
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
        $comment = $blog_post->comments()->create([
            'content'=> $request->input('content'),
            'user_id' => $request->user()->id
        ]);

        /*  This is for immediately send without queue */
        /*Mail::to($blog_post->user)->send(
            new CommentPostedMarkdown($comment)
        ); */

        /*  Add queue and process job instant */
        // Mail::to($blog_post->user)->queue(
        //     new CommentPostedMarkdown($comment)
        // );

        event(new EventsCommentPosted($comment));

        

        // $when = now()->addMinutes(1);
        // Mail::to($blog_post->user)->later($when , new CommentPostedMarkdown($comment) );


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
