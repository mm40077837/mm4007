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
    
    public function store(Request $request, Post $post) 
    {
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

            $image=$request->file('image')->getClientOriginalName();
           
            $request->file('image')->storeAs('',$image,'public');

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
    
    public function show(Post $post, Comment $comment, User $user) 
    {
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

        
        if ($like->like_exist($id, $posts_id)) {
            
            $like = Like::where('posts_id', $posts_id)->where('users_id', $id)->delete();
        } else {
            
            $like = new Like;
            $like->posts_id = $request->posts_id;
            $like->users_id = Auth::user()->id;
            $like->save();
        }

        $postLikesCount = $post->loadCount('likes')->likes_count;
        $exist = Like::where('posts_id', $posts_id)->where('users_id', $id)->first();
        
        $json = [
            'postLikesCount' => $postLikesCount,
            'exist' => $exist,
        ];
        
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

             $image=$request->file('image')->getClientOriginalName();
            
            $request->file('image')->storeAs('',$image,'public');
            
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
    public function destroy(Post $post) 
    {
        $post->delete();
        return redirect('/mypage');
    }
}