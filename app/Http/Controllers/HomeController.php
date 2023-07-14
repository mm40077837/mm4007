<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, Post $post) 
    {
        //クエリの生成
        $query = Post::query();

        //キーワード受け取り
        $keyword = $request->input('keyword');

        //dateの受け取り
        $date = $request->input('date');
        
        //もしキーワードがあったら
        if(!empty($keyword))
        {
            $query->whereHas('user', function($q) use($keyword){
                
            $q->where('name','like','%'.$keyword.'%')->orWhere('post','like','%'.$keyword.'%');
                
            });
        }
        if(!empty($date))
        {
            $query->whereHas('user', function($q) use($date){
            $carbon = new Carbon($date);

            $q->whereDate('date','>=', $date );
                
            });
        }
        $posts = $query->orderBy('date','desc')->get();
        // dd($posts[0]->user);

        return view('home', compact('posts','keyword'));

        }
}
