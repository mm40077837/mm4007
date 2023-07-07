<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\support\Facades\Auth;
use Illuminate\Http\Request;
use InterventionImage;


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
    public function create() //新規投稿について
    {
        return view("post_new");
        //新規追加しているからview
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request) //新規投稿したものがDBに保存され手メインページへ配置される場所
    {
        $post = new Post;

        $post->title = $request->title;
        $post->date = $request->date;
        $post->post = $request->post;
        $post->users_id = Auth::id();
        
        //画像ファイルの保存場所
         if($request->image){
            $image=$request->file('image')->getClientOriginalName();
            //写真の名前ファイルの名前を取得する関数
            $request->file('image')->storeAs('',$image,'public');
            //第１引数(public/image)にどこに保存するのか記載。
            //第２引数($image)に何を保存するのかを記載。
            $file = $request->file('image');
            //画像のリサイズ
            $resized = InterventionImage::make($file)->resize(100,100,function($constraint){
                $constraint->aspectRatio();
            })->save();

            //画像の保存
            Storage::put('public/' . $post->image, $resized);
           
        }

        $post->save();

        return redirect('/home');
        //REDIRECT使用するのは新規追加ではなく更新をするから
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($id) //各々の詳細ページが見れる
    {
        $post = Post::find($id);
        return view('show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //投稿編集画面
    {
        // $data = Post::findOrFail($id);
        // return view('edit',['message' => '編集フォーム','data' => $data]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post) //投稿削除
    {
        //
    }
}
