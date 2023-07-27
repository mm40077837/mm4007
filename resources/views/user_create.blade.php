@extends('layouts.app')

@section('content')
<div class="text-center my-5">
    <form action="{{ route('users.iconupdate', Auth::id()) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" id="icon" name="icon">
        <div class="my-5">
            <button type="submit" class="btn btn-primary">アイコンを追加する</button>
            <a href="#" class="btn btn-secondary"onclick='window.history.back(-1);'>戻る</a>
            <a href="/home" class="btn btn-secondary">ホームへ</a>
        </div> 
    </form>
 </div>    
@endsection