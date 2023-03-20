<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserCommentController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( User $user ,StoreComment $request)
    {
        //
        $user->commentsOn()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);
        
        //$request->session()->flash('status', 'Comment was created!');
        return redirect()->back()->with('status', 'Comment was created!');
    }
}
