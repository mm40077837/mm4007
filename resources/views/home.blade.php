@extends('layouts.app')

@section('content')

@if(Auth::user()->admin != 1)
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex mx-5">
            <form action="{{ route('home') }}" method="GET"> 
                @csrf
                <input type="text" name="keyword" placeholder="検索内容" value="{{ $keyword }}">       
                <input type="date" name="date" placeholder="ユーザ名">
                <button type="submit" class="btn btn-primary text-nowrap">投稿検索</button>
            </form>
            <a href="{{ route('posts.create') }}" class="mx-3"> 
                <button type="submit" class="btn btn-primary text-nowrap">新規追加</button>
            </a>
            <a href="{{ route('mypage.index') }}">
                <button type="submit" class="btn btn-primary text-nowrap">マイページへ</button>
            </a>
            
        </div> 
    </div>
</div>

<div class="mt-5 p-5 container"  style="padding: auto;">
    <div class="text-left d-flex flex-wrap raw" style="margin-left: 160px; margin-right: 140px;">
        @foreach($posts as $post)
            <table class="p-5 mb-5" style="margin: 10px; background-color: white; margin: 0 auto; box-shadow: 12px 12px 0px 0 rgb(238, 238, 238);">
                <tr>
                    <th>
                        @if(empty($post->user->icon))
                            No Image
                        @elseif(!empty($post->user->icon))
                            <img src="{{ asset('storage/'.$post->user->icon) }}" style=" padding: 10px; width: 90px; height: 90px; object-fit: cover; border-radius: 50%;"></th>
                        @endif
                    </th>
                    <th scope='col' class="p-3"><a href="{{ route('posts.show',$post['id']) }}" class="text-secondary">{{ $post['title'] }}</a></th>   
                    @if(empty($post->user->name))
                        <th scope='col' class="pr-3">アカウントは存在しません。</th>
                    @elseif(!empty($post->user->name))
                        <th scope='col' class="pr-3">{{ $post->user->name }}</th>
                    @endif
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
            </table>
        @endforeach
    </div>
</div>
@else
<div class="text-center">
    <div class="m-5">
        <form action="{{ route('admin.strator') }}" method="get"> 
            <button type="submit" class="btn btn-primary text-nowrap">ユーザー管理ページへ</button>
        </form>
    </div>
    <div class="">
        <form action="{{ route('admin.post') }}" method="get">
            <button type="submit" class="btn btn-primary text-nowrap">投稿管理ページへ</button>
        </form>
    </div>
<div>
@endif

@endsection


