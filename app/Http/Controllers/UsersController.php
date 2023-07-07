<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('user_create',[
            "users" => $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @param  int  $id
     */
    public function create()
    {
        return view("user_create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {   
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('mypage');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user_edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //アカウント編集時のバリデーション
        $request->validate([
            "name" => "required|max:255",
            "email" => "required|email:filter,dns",
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

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
        
        $user->save();
        return redirect('mypage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/home');
    }
}
