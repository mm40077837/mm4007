<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\User;
use Illuminate\support\Facades\Auth;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //新規投稿画面へ遷移
    {
        
        return view("post_new");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request, Post $post) //新規投稿したものがDBに保存され手メインページへ配置される場所
    {
        //新規投稿時のバリデーション
        $request->validate([
            "title" => "required|max:255",
            "date" => "required",
            "post" => "required|max:500"
        ]);

        $post->title = $request->title;
        $post->date = $request->date;
        $post->post = $request->post;
        $post->users_id = Auth::id();
        
        if($request->image){

            //画像ファイルの保存場所
             $image=$request->file('image')->getClientOriginalName();
            //写真の名前ファイルの名前を取得する関数
            $request->file('image')->storeAs('',$image,'public');
            //第１引数(public/image)にどこに保存するのか記載。
            //第２引数($image)に何を保存するのかを記載。

            $post->image = $image;
        }

        $post->save();

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    
    public function show(Request $request, Post $post, Comment $comment, User $user) //各々の詳細ページが見れる
    {
        
        $all = $comment->with('user')->where('posts_id','=',$post['id'])->get()->toArray();

        return view('show')->with( ['post'=> $post ,'comment'=>$all] );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) //投稿編集画面
    {
        return view('edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Post $post) //投稿の更新
    {  
        //投稿編集時のバリデーション
        $request->validate([
            "title" => "required|max:255",
            "date" => "required",
            "post" => "required|max:500"
        ]);

        $post->title = $request->title;
        $post->date = $request->date;
        $post->post = $request->post;
        $post->users_id = Auth::id();
        
        if($request->image){

            //画像ファイルの保存場所
             $image=$request->file('image')->getClientOriginalName();
            //写真の名前ファイルの名前を取得する関数
            $request->file('image')->storeAs('',$image,'public');
            //第１引数(public/image)にどこに保存するのか記載。
            //第２引数($image)に何を保存するのかを記載。
            
            $post->image = $image;
        }

        $post->save();
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post) //投稿削除
    {
        $post->delete();
        return redirect('/home');
    }
}