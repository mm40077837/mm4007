<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\User;
use App\Like;
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
    
    public function show(Post $post, Comment $comment, User $user) //各々の詳細ページが見れる
    {
        // ユーザの投稿の一覧を作成日時の降順で取得
        //withCount('テーブル名')とすることで、リレーションの数も取得。
        $posts = Post::where('id' ,$post['id'])->with('user')->withCount('likes')->orderBy('created_at', 'desc')->first()->toArray();
   
        $like_model = new Like;
        
        $all = $comment->with('user')->where('posts_id','=',$post['id'])->get()->toArray();
        
        return view('show')->with( ['post'=> $posts ,'comment'=>$all, 'like_model'=>$like_model,] );
    }

        public function ajaxlike(Request $request)
    {
        $id = Auth::user()->id;
        $posts_id = $request->posts_id;
        $like = new Like;
        $post = Post::findOrFail($posts_id);

        // 空でない（既にいいねしている）なら
        if ($like->like_exist($id, $posts_id)) {
            //likesテーブルのレコードを削除
            $like = Like::where('posts_id', $posts_id)->where('users_id', $id)->delete();
        } else {
            //空（まだ「いいね」していない）ならlikesテーブルに新しいレコードを作成する
            $like = new Like;
            $like->posts_id = $request->posts_id;
            $like->users_id = Auth::user()->id;
            $like->save();
        }

        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        $postLikesCount = $post->loadCount('likes')->likes_count;
        $exist = Like::where('posts_id', $posts_id)->where('users_id', $id)->first();
        //一つの変数にajaxに渡す値をまとめる
        //今回ぐらい少ない時は別にまとめなくてもいいけど一応。笑
        $json = [
            'postLikesCount' => $postLikesCount,
            'exist' => $exist,
        ];
        //下記の記述でajaxに引数の値を返す
        return response()->json($json);
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
        // //投稿編集時のバリデーション
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
        return redirect('/mypage');
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
        return redirect('/mypage');
    }
}