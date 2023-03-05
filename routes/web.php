<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\HomeCrontroller;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\PostsCommentsCrontroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeCrontroller::class,'index'])->name('home');

Route::any('/contact', function (Request $request) {
    return view('contact.contact');
})->name('contact');

Route::get('/secret', [HomeCrontroller::class, 'secret'])->name('secret')->middleware('can:home.secret');

//Route::post('posts/comment', [PostsController::class,'create_comment']);
Route::resource('posts', PostsController::class);
Route::resource('posts.comments', PostsCommentsCrontroller::class)->only(['store']);
Route::post('posts/{id}/restore', [PostsController::class, 'restore'])->name('posts.restore');

Route::get('posts/tag/{tag}', [PostTagController::class, 'index'])->name('posts.tags.index');

/*
Route::get('/posts/{id}', function ($id) {

    $posts = array(
        1 => ['id'=>1,'title'=>'Posts 1','description'=>'The link is reliable, confidential, and safe. Above anything else, it is less expensive designed for long-distance phone calls'],
        2 => ['id'=>2,'title'=>'Posts 2','description'=>'but it was seldom seen in the households of average Americans until lately. All of that changed '],
        3 => ['id'=>3,'title'=>'Posts 3','description'=>'Moving to VoIP is especially beneficial when you have an out-of-country family with whom you communicate frequently.']
    );

    abort_if(!isset($posts[$id]), 404);

    return view('posts.single-post',['post'=>$posts[$id]]);
})->whereAlphaNumeric('id');

Route::any('/contact', function (Request $request) {
    //dd($request->old('phone'));
    if($request->isMethod('post')){
        //$request->flashOnly(['name', 'phone']);;
        
        //dd($request->input());
        //dd($request->input('phone.*'));
        //dd($request->collect('phone'));
        //dd($request->all());
        //dd($request->input('name'));

        // file handling
        //$file = $request->file('profile_logo');
        $path = $request->profile_logo->store('images');
        dd($path);
    }
    return view('contact.contact');
});


Route::any('/greeting', function () {
    return 'Hello World';
});

Route::redirect('/here', '/there', 302);

Route::get('/user/{id}', function ($id) {
    return 'User '.$id;
})->where(['id' => '[0-9]+']);

Route::get('/user/{name?}', function ($name = 'John') {
    return $name;
})->where(['name' => '[a-z]+']);


Route::get('/search/{name?}/test', function ($name = 'John') {
    $url = route('search', ['name'=>'hhhh','photos' => 'yes']);
    return $url;

    //return $search;
})->where('search', '.*')->name('search');


Route::get('/user/{id}/profile', function ($id) {
    $url = route('profile', ['id' => 1, 'photos' => 'yes']);
    return $url;
    //
})->name('profile');

Route::prefix('admin')->group(function () {
    Route::get('/users', function () {
        return 'All users from admin panel';
    });

    Route::get('/posts', function () {
        return 'All posts from admin panel';
    });
});
*/ 

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
