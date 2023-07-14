@extends('layouts.app')

@section('content')
<div class="text-left w-25" style="margin: auto;">
    <table class="table table-st riped p-5 mb-5 bg-info" >
        <tr>
            <th>タイトル</th>
            <td>{{ $post->title }}</td>   
        </tr>
        <tr>
            <th>投稿者</th>
            <td>{{ $post['user']['name'] }}</td>   
        </tr>
        <tr>
            <th>投稿日</th>
            <td>{{ $post->date }}</td>
        </tr>
        <tr>
            <th>投稿</th>
            <td>{{ $post->post }}</td>
        </tr>
        <tr>
            <th>写真</th>
            <td>
                @if(empty($post['image']))
                 画像の投稿はありません
                @elseif(!empty($post['image']))
                <img src="{{ asset('storage/'.$post['image']) }}" style="width: 230px; height: 230px; object-fit: cover;">
                @endif
            </td>
        </tr>

        <tr>
            <th scope='col' class="pl-3 pb-3">
                <a href="{{ route('comments.create' ,['post'=>$post['id']] ) }}"><!--★コメント入力画面へ遷移-->
                    <button type="submit" class="text-white">💬:コメント</button>
                </a>
            </th>
            <th scope='col' class="pl-3 pb-3 text-white">
                ❤:いいね
            </th>
        </tr>
        @foreach($comment as $comments) 
        <tr>
            <th>  
                {{ $comments['user']['name'] }}<br>
                コメント : {{ $comments['comment']}}
            </th>
        </tr>    
        @endforeach            
    </table>
    <div class="text-right">
        <a href="#" class="btn btn-secondary"onclick='window.history.back(-1);'>戻る</a>
        <form action="{{ route('violation.create',['post'=>$post['id']]) }}" method="get"> <!--★違反報告ページへ遷移-->
            <button type="submit" class="btn btn-primary text-nowrap">違反報告ページへ</button>
        </form>
    </div>
</div>

@endsection

