<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class HomeCrontroller extends Controller
{
    //

    public function index(){
        //Redis::set('name', 'Taylor');
        
        //dd(Redis::get('name'));
        return view('home.index',['user_details' => ['name'=>'Pritam Das','age'=>30,'address'=>'westbengal, 700048','meta_data'=>['contact'=>'655454335','fav_subject'=>['geography','bengali','Environment science'], 'fav_tv_show'=>['wwe','man vs wild']  ]]]);
    }

    public function secret(){
        return view('secret');
    }
}
