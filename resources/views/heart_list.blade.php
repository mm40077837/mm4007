@extends('layouts.app')

@section('content')
    
@foreach($like_with_post as $like_with_posts)
<div class="text-left" style="margin: auto; width: 500px;">
<table class="table table-st riped p-5 mb-5" style="background-color: #008b8b;">
        <tr>
            <th>タイトル</th>
            <td>{{ $like_with_posts['title'] }}</td>   
        </tr>
        <tr>
            <th>投稿者</th>
            <td>{{ $like_with_posts['user']['name'] }}</td>   
        </tr>
        <tr>
            <th>投稿日</th>
            <td>{{ $like_with_posts['date'] }}</td>
        </tr>
        <tr>
            <th>投稿</th>
            <td>{{ $like_with_posts['post'] }}</td>
        </tr>
        <tr>
            <th>写真</th>
            <td>
                @if(empty($like_with_posts['image']))
                 画像の投稿はありません
                @elseif(!empty($like_with_posts['image']))
                <img src="{{ asset('storage/'.$like_with_posts['image']) }}" style="width: 230px; height: 230px; object-fit: cover;">
                @endif
            </td>
        </tr>

        <tr>
            <th scope='col' class="pl-3 pb-3">
                <a href="{{ route('comments.create' ,['post'=>$like_with_posts['id']] ) }}">
                    <button type="submit" class="btn text-white">💬:コメント</button>
                </a>
            </th>
            <th scope='col' class="pl-3 pb-3 text-white">
                
                <p class="favorite-marke">
                <a class="js-like-toggle loved" href="" data-postid="{{ $like_with_posts['id'] }}"><button type="button" class="like btn text-white">❤</button></a>
                <span class="likesCount">{{$like_with_posts['likes_count']}}</span>
                </p>
                
            </th>
        </tr>
</table>
</div>
    @endforeach    
<div class="text-center">
    <table>
        <tr>
            <th><a href="#" class="btn btn-secondary"onclick='window.history.back(-1);'>戻る</a></th>
            <th><a href="/home" class="btn btn-secondary">ホームへ</a></th>
        </tr>
    </table>
</div>
@endsection