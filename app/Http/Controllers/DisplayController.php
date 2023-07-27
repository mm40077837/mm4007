<?php

namespace App\Http\Controllers;

use App\Violation;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use App\Post;
use App\User;
use App\Like;


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

                $image=$request->file('icon')->getClientOriginalName();
                
                $request->file('icon')->storeAs('',$image,'public');
                
                $user->icon = $image;
            }

            $user->save();
            return redirect('mypage');
        }
        public function createviolation($id)
        {
            return view('violation_create')->with('id',$id);
        }
        public function storeviolation(Request $request, Violation $violation)
        {
            
            $violation->users_id = Auth::id();
            
            $violation->report = $request->violation;
            
            $violation->posts_id = $request->posts_id;

            $violation->save();
            return redirect('/home');
        }
        public function administrator() 
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

        public function adminpost(User $user) 
        {
            $post = new Post;
            $type = 0;

            $all = $post->where('del_flg', $type)->with('user')->withCount('violation')->orderBy('violation_count','desc')->take(20)->get()->toArray();
            
            return view('post_list',[
                'posts' => $all,
            ]);
        }

        public function logicaldelete($id) 
        { 
            $post = new Post;
            
            $record = $post->find($id);
        
            $record->del_flg = 1;
            
            $record->save();

            return redirect('post_list');

        }

        public function heartlist() 
        { 
            $posting = new Post;

            $like_with_post = $posting->join('likes','posts.id','likes.posts_id')->where('likes.users_id','=',Auth::id())->get();

            return view('heart_list',compact('like_with_post'));

        }
    }
    
    

