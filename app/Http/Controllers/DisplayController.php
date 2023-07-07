<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use App\Post;
use App\User;

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

    public function iconupdate(Request $request, User $user)
    {
        if($request->icon){

            //画像ファイルの保存場所
             $image=$request->file('icon')->getClientOriginalName();
            //写真の名前ファイルの名前を取得する関数
            $request->file('icon')->storeAs('',$image,'public');
            //第１引数(public/image)にどこに保存するのか記載。
            //第２引数($image)に何を保存するのかを記載。
            
            $user->icon = $image;
        }

        $user->save();
        return redirect('mypage');
    }
}
