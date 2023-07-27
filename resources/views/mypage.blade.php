@extends('layouts.app')

@section('content')
<div class="">
    <div class="text-center">
        @if(empty(Auth::user()->icon))
        NO IMAGE
        @elseif(!empty(Auth::user()->icon))
        <img src="{{ asset('storage/'.Auth::user()->icon) }}" style="width: 230px; height: 230px; object-fit: cover; border-radius: 50%;"></div>
        @endif
    </div>
    <div class="text-center my-3 font-weight-bold">
        {{ Auth::user()->name }}
    </div>
    <div class="text-center font-weight-bold">
        {{ Auth::user()->email }}
    </div>

    <div class="d-flex justify-content-sm-center my-3">
        <form action="{{ route('users.edit', Auth::user()) }}" method="get" class="mx-1">
            <button type="submit" class="btn btn-primary text-nowrap">編集</button>
        </form>

        <form action="{{ route('users.destroy', Auth::user()) }}" method="post" class="mx-1">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-primary text-nowrap" onclick='return confirm("本当に退会しますか？");'>退会</button>
        </form>
    
        <form action="{{ route('users.store')}}" mehod="post" class="mx-1">
            <button type="submit" class="btn btn-primary text-nowrap">アイコン追加・変更</button>
        </form>
        <form action="{{ route('heart.list')}}" mehod="get" class="mx-1">
            <button type="submit" class="btn btn-primary text-nowrap">いいね投稿一覧</button>
        </form>
        <a href="#" class="btn btn-secondary mx-1" onclick='window.history.back(-1);'>戻る</a>
        <a href="/home" class="btn btn-secondary mx-1">ホームへ</a>
    </div>
</div>

<div class="text-left d-flex flex-wrap" style="margin-left: 80px; margin-right: 30px;">
    @foreach($posts as $post)
        <table class="p-5 mb-5" style="margin: 10px; background-color: #ffffff;">
            <tr>
                
                <th scope='col' class="p-3">{{ $post['title'] }}</th>
                <th scope='col' class="pr-3">{{ $post['date'] }}</th>
            </tr>
            <tr>
                <th scope='col' class="pl-3">{{ $post['post'] }}</th>
            </tr>
            <tr>
                <th scope='col' class="pl-3 pb-3">
                    @if(empty($post['image']))
                    画像の投稿はありません
                    @elseif(!empty($post['image']))
                    <img src="{{ asset('storage/'.$post['image']) }}" style="width: 230px; height: 230px; object-fit: cover;">
                    @endif
                </th>
            </tr>
            <tr>
                <td class="d-flex justify-content-around my-3 mx-5">
                    <form action="{{ route('posts.edit',$post['id']) }}" method="get">
                        <button type="submit" class="btn btn-primary text-nowrap">編集</button>
                    </form>
                    <form action="{{ route('posts.destroy',$post['id']) }}" method="POST" onclick='return confirm("本当に削除しますか？");'>
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger text-nowrap">削除</button>
                    </form>
                </td>      
            </tr>
        </table>
    @endforeach      
</div>
@endsection