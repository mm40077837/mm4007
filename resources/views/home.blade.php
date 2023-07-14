@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex">
            <form action="" mehod="GET"> 
                @csrf<!--外部アクセス拒否-->
                <input type="text" name="username" placeholder="ユーザ名">
                <input type="text" name="title" placeholder="タイトル">
                <input type="date" name="date" placeholder="ユーザ名">
                <button type="submit" class="btn btn-primary text-nowrap">投稿検索</button>
            </form>
            <a href="{{ route('posts.create') }}"><!--★新規投稿画面へ遷移-->
                <button type="submit" class="btn btn-primary text-nowrap">新規追加</button>
            </a>
            <a href="{{ route('mypage.index') }}"><!--★マイページへ遷移-->
                <button type="submit" class="btn btn-primary text-nowrap">マイページへ</button>
            </a>
            
        </div> 
    </div>
</div>
<div class="bg-success mt-5 p-5"  style="padding: auto;">
    <div class="text-left d-flex flex-wrap" style="margin-left: 160px; margin-right: 140px;">
        @foreach($posts as $post)
            <table class="bg-info p-5 mb-5" style="margin: 10px;">
                <tr>
                    <th>
                        <img src="{{ asset('storage/'.$post['user']['icon']) }}" style=" padding: 10px; width: 90px; height: 90px; object-fit: cover; border-radius: 50%;"></th>
                    <th scope='col' class="p-3"><a href="{{ route('posts.show',$post['id']) }}" class="text-secondary">{{ $post['title'] }}</a></th> <!--★詳細画面へ遷移-->      
                    <th scope='col' class="pr-3">{{ $post['date'] }}</th>
                </tr>
                <tr>
                    <th scope='col' class="pl-3">{{ $post['post'] }}</th>
                </tr>
                <tr>
                    <th scope='col' class="pl-3 pb-3">
                        @if(empty($post['image']))
                         
                        @elseif(!empty($post['image']))
                        <img src="{{ asset('storage/'.$post['image']) }}" style="width: 230px; height: 230px; object-fit: cover;">
                        @endif
                    </th>
                </tr>
            </table>
        @endforeach
    </div>
</div>
@endsection


