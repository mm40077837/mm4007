<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
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

        $query = Post::query()->where('del_flg', 0);

        $keyword = $request->input('keyword');

        $date = $request->input('date');
        
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
        
        $posts = $query->with('user')->orderBy('date','desc')->get();
       
        return view('home', compact('posts','keyword'));

        }
}
