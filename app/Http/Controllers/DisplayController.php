<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use App\Post;

class DisplayController extends Controller
{
    public function index()
    {
        $post = new Post;

        $posts=$post->where('users_id', Auth::id())->get();

        return view('mypage',[
            'posts' => $posts,
        ]);
    }
}
