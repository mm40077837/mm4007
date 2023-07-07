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

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @method('patch')
                <!--enctype="multipart/form-data" をformに入れないとファイルは登録されない--> 
                @csrf<!--外部アクセス拒否-->
                <input type="text" name="title" placeholder="タイトル" value="{{ old('title', $post['title']) }}"><br>
                <input type="date" name="date" placeholder="0000/00/00" value="{{ old('date', $post['date']) }}"><br>
                <textarea name="post">{{ old('post', $post['post']) }}</textarea><br>
                <input type="file" id="image" name="image">
                <button type="submit" class="btn btn-primary">編集する</button>
            </form>
        </div>
    </div>
</div>

<div class="text-right">
    <a href="#" class="btn btn-secondary"onclick='window.history.back(-1);'>戻る</a>
</div>
@endsection

