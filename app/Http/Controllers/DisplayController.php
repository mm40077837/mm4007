<?php

namespace App\Http\Controllers;

use App\Violation;
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
    public function createviolation($id) //違反報告ページへ以降するためのメソッド
    {
        
        //違反報告ページの表示（投稿に対しての違反報告するための記述も含めて！)
        return view('violation_create')->with('id',$id);
    }
    public function storeviolation(Request $request, Violation $violation) //違反報告を投稿するためのメソッド
    {
        //対象idをdbに登録（誰が違反報告したか）
        $violation->users_id = Auth::id();
        //テキストエリアに書かれた違反報告をreportカラムに登録
        $violation->report = $request->violation;
        //対象idをdbに登録（どの投稿に違反報告したか）
        $violation->posts_id = $request->posts_id;

        $violation->save();
        return redirect('/home');
    }
    public function administrator() //管理者画面（ユーザーの一覧）
    {
        $user = new User;
       
        $a = $user->withCount([
                'post AS total_view_count' => function($query){
                 $type = 1;
                 $query->where('del_flg', $type); }])->orderBy('total_view_count','desc')->take(10)->get()->toArray();

            return view('/user_list',[
                'a' => $a,
            ]);
    }

    public function adminpost(User $user) //管理者画面（投稿の一覧）
    {
        $post = new Post;
        $type = 0;

        //userも含めた全件取得
        $all = $post->where('del_flg', $type)->with('user')->withCount('violation')->orderBy('violation_count','desc')->take(20)->get()->toArray();
        
        return view('post_list',[
            'posts' => $all,
        ]);
     }

     public function logicaldelete($id) //表示停止
     { 

        //インスタンス化
        $post = new Post;
        
        //モデルから対処とするカラムの抽出
        
        $record = $post->find($id);
       
        $record->del_flg = 1;
        
        $record->save();

        return redirect('post_list');

    }
    }
    
    

