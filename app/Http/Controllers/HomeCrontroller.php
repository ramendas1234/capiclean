<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class HomeCrontroller extends Controller
{
    //

    public function index(){
        //Redis::set('name', 'Taylor');
        
        //dd(Redis::get('name'));

        $sliderPosts = BlogPost::whereIn('id', [11, 12, 56])->get();
        $postGridSection = BlogPost::inRandomOrder()->limit(12)->get();
        return view('home.index',['sliderPosts' => $sliderPosts, 'postGridSection' => $postGridSection]);
    }

    public function secret(){
        return view('secret');
    }
}
