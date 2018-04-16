<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Cache;
class RedisController extends Controller
{
    //

    public function index(){
    	Redis::set('name','wrw');
    }

    public function cacheRedis(){
    	//以Redis设置缓存
    	Cache::store('redis')->
    	put('test','i love you ',120);
    }
}
