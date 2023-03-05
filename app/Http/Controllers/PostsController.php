<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BlogPost;
use App\Scopes\LatestScope;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;


class PostsController extends Controller
{


    // private $posts = array(
    //     1 => ['id'=>1,'title'=>'Posts 1','description'=>'The link is reliable, confidential, and safe. Above anything else, it is less expensive designed for long-distance phone calls'],
    //     2 => ['id'=>2,'title'=>'Posts 2','description'=>'but it was seldom seen in the households of average Americans until lately. All of that changed '],
    //     3 => ['id'=>3,'title'=>'Posts 3','description'=>'Moving to VoIP is especially beneficial when you have an out-of-country family with whom you communicate frequently.']
    // );

    public function __construct()
    {
        $this->middleware('auth')->only(['create','store','edit','update','destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // comments_count 

        // 'posts'=>BlogPost::latest()->withCount('comments')->get()
        // BlogPost::withoutGlobalScope(LatestScope::class)->withCount('comments')->get()

        // multiple local scope
        // BlogPost::ramen()->richard()->withCount('comments')->get()

        $mostCommentPosts = Cache::tags(['blog-post'])->remember('blog-post-commented', now()->addSeconds(600), function(){
            return BlogPost::mostComment()->take(5)->get() ;
        });

        $mostActiveUsers = Cache::remember('users-most-active', now()->addSeconds(600), function(){
            return User::mostActiveUser()->take(3)->get() ;
        });

        $mostActiveLastMonth = Cache::remember('users-most-active-last-month', now()->addSeconds(600), function(){
            return User::mostBlogPostsLastMonth()->take(3)->get() ;
        });

        return view(
            'posts.index',
            [
                'posts'=>BlogPost::ramen()->withCount('comments')->with('user')->with('tags')->get(),
                'mostCommentPosts' => $mostCommentPosts,
                'mostActiveUsers' => $mostActiveUsers,
                'mostActiveLastMonth' => $mostActiveLastMonth
            ]
        );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //$this->authorize(BlogPost::class);
        return view('posts.post-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        
        //
        //$this->authorize(BlogPost::class);
        $validated = $request->validated();
        
        //$post = BlogPost::create($validated);
        /*  Way one */
        /*$user = Auth::user();
        $post = BlogPost::make([
            'title'=>$validated['title'],
            'content'=>$validated['content'],
        ]);
        $post->user()->associate($user)->save(); */


        /*  Way Two */
        $post = BlogPost::make([
            'title'=>$validated['title'],
            'content'=>$validated['content'],
        ]);
        $user = User::find(Auth::id());
        $user->blogPost()->save($post);


        // $post = new BlogPost();
        // $post->title = $validated['title'];
        // $post->content = $validated['content'];
        // $post->save();
        $request->session()->flash('status','Post created successfully');

        return redirect()->route('posts.show',['post'=>$post->id]);
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
        //abort_if(!isset($this->posts[$id]), 404);
        //$post = BlogPost::with('comments')->where('id', $id)->first();
        
        // $post = BlogPost::with(['comments', function($query){
        //     return $query->latest();
        // }])->findOrFail($id);

       $post = Cache::tags(['blog-post'])->remember("blog-post-{$id}", now()->addSeconds(600), function() use ($id){
            return BlogPost::with('comments')->with('user')->with('tags')->findOrFail($id);
       });

        //$post = BlogPost::with('comments')->findOrFail($id);
       

        return view('posts.single-post',['post'=>$post]);
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
        $post = BlogPost::findOrFail($id);
        // if(Gate::denies('update-post', $post)){
        //     abort(403, "you can't edit this post");
        // }

        //$this->authorize('update',$post);
        $this->authorize($post);
        
        return view('posts.post-edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        //
        $post = BlogPost::findOrFail($id);

        // if(Gate::denies('update-post', $post)){
        //     abort(403, "you can't update this post");
        // }

        //$this->authorize('update',$post);
        $this->authorize($post);


        $validated = $request->validated();
        $post->fill($validated);
        /*$post->fill([
            'title'=>$validated['post_title'],
            'content'=>$validated['post_content']
        ]); */
        $post->save();
        $request->session()->flash('status','Post updated successfully');
        return redirect()->route('posts.show',['post'=>$post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //

        $post = BlogPost::findOrFail($id);

        // if(Gate::denies('delete-post', $post)){
        //     abort(403, "you can't delete this post");
        // }
        //$this->authorize('delete',$post);
        $this->authorize($post);

        $post->delete();

        // BlogPost::destroy($id);

        $request->session()->flash('status', 'Blog post was deleted!');

        return redirect()->route('posts.index');
    }


    public function restore(Request $request, $id) 
    {   
        BlogPost::withTrashed()->find($id)->restore();
        return redirect()->route('posts.index');
    }

}
