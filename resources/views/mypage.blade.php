@extends('layouts.app')

@section('content')
<div class=""><!--アカウント表示-->
    <div class=""></div>
    <div class="">{{ Auth::user()->icon }}</div>
    <div class="">{{ Auth::user()->name }}</div>
    <div class="">{{ Auth::user()->email }}</div>
    <div class="">
                    <a href="{{ route('users.edit', Auth::user()) }}"><!--★アカウント編集画面へ遷移-->
                        <button type="submit" class="btn btn-primary text-nowrap">編集</button>
                    </a>
                    <a href="{{ route('users.destroy', Auth::user()) }}" onclick='return confirm("本当に退会しますか？");'><!--★アカウント削除機能-->
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-primary text-nowrap">退会</button>
                    </a>
                    <a href="{{ route('users.create')}}"><!--★アカウントアイコン追加機能-->
                        <button type="submit" class="btn btn-primary text-nowrap">アイコン追加</button>
                    </a>
</div>

<div class="text-left d-flex flex-wrap" style="margin-left: 80px; margin-right: 30px;">
    @foreach($posts as $post)
        <table class="bg-info p-5 mb-5" style="margin: 10px;">
            <tr>
                <th scope='col' class="p-3">{{ $post['title'] }}</th>
                <th scope='col' class="pr-3">{{ $post['date'] }}</th>
            </tr>
            <tr>
                <th scope='col' class="pl-3">{{ $post['post'] }}</th>
            </tr>
            <tr>
                <th scope='col' class="pl-3 pb-3"><img src="{{ asset('storage/'.$post['image']) }}" style="width: 230px; height: 230px; object-fit: cover;"></th>
            </tr>
            <tr>
                <th>
                    <a href="{{ route('posts.edit',$post['id']) }}"><!--★投稿編集画面へ遷移-->
                        <button type="submit" class="btn btn-primary text-nowrap">編集</button>
                    </a>
                </th>
                <th>
                    <form action="{{ route('posts.destroy',$post['id']) }}" method=POST onclick='return confirm("本当に削除しますか？");'><!--★投稿削除機能-->
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-primary text-nowrap">退会</button>
                    </form>
                </th>
            </tr>
        </table>
    @endforeach    
</div>
<div class="text-right">
        <a href="#" class="btn btn-secondary"onclick='window.history.back(-1);'>戻る</a>
</div>
@endsection