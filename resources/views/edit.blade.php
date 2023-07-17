@extends('layouts.app')

@section('content')
<div class="container">
    <!--新規投稿時のバリデーション-->
    <div>  
        @if ($errors->any())  
            <ul>  
                @foreach ($errors->all() as $error)  
                    <li class="text-danger list-unstyled">{{ $error }}</li>  
                @endforeach  
            </ul>  
        @endif  
    </div>
    <div class="text-center">
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @method('patch')
            <!--enctype="multipart/form-data" をformに入れないとファイルは登録されない--> 
            @csrf<!--外部アクセス拒否-->
            <div class="mb-3">
                <lavel for="formGroupExampleInput" class="form-lavel">タイトル</lavel>
                <input type="text" name="title" placeholder="タイトル" value="{{ old('title', $post['title']) }}">
            </div>
            <div class="mb-3">
                <lavel for="formGroupExampleInput2" class="form-lavel">投稿日</lavel>
                <input type="date" name="date" placeholder="0000/00/00" value="{{ old('date', $post['date']) }}">
            </div>
            <div class="mb-3">
                <lavel for="formGroupExampleInput3" class="form-lavel">投稿内容</lavel>
                <textarea name="post">{{ old('post', $post['post']) }}</textarea><br>
            </div>
            <div class="mb-3">
                <lavel for="formGroupExampleInput4" class="form-lavel">投稿画像</lavel>
                <input type="file" id="image" name="image">
            </div>
            <div class="text-center">
            <button type="submit" class="btn btn-primary">編集する</button>
                <a href="#" class="btn btn-secondary"onclick='window.history.back(-1);'>戻る</a>
                <a href="/home" class="btn btn-secondary">ホームへ</a>
            </div>
        </form>
    </div>
</div>
@endsection

