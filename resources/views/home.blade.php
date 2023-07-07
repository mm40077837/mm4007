@extends('layouts.app')
<script src="{{ asset('js/resize.js') }}" defer></script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex">
            <form action="" mehod="GET"> 
            @csrf<!--外部からアクセスされないようにする！form action使うとき必ず入れる！-->
                <input type="text" name="username" placeholder="ユーザ名">
                <input type="text" name="title" placeholder="タイトル">
                <input type="date" name="date" placeholder="ユーザ名">
                <button type="submit" class="btn btn-primary text-nowrap">投稿検索</button>
            </form>
            <a href="{{ route('Posts.create') }}">
                <button type="submit" class="btn btn-primary text-nowrap">新規追加</button>
            </a>
            <a href="{{ route('Mypage.index') }}">
                <button type="submit" class="btn btn-primary text-nowrap">マイページへ</button>
            </a>
        </div> 
    </div>
    <table>
            @foreach($posts as $post)
                <tr>
                    <th scope='col'><a href="{{ route('Posts.show',$post['id']) }}">{{ $post['title'] }}</a></th>
                    
                    <th scope='col'>{{ $post['date'] }}</th>
                </tr>
                <tr>
                    <th scope='col'>{{ $post['post'] }}</th>
                    <th scope='col'><img src="{{ asset('storage/'.$post['image']) }}" style="width: 230px; height: 230px;"></th>
                </tr>
            @endforeach
            </table>
</div>
@endsection
