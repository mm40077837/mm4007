@extends('layouts.app')

@section('content')
    <div class="container">
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
            <div class="col-md-8 text-center p-5">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="title" class="m-3" placeholder="タイトル" value="{{ old('title') }}"><br>
                    <input type="date" name="date" class="m-3" placeholder="0000/00/00" value="{{ old('date') }}"><br>
                    <textarea name="post" class="m-3">{{ old('post') }}</textarea><br>
                    <input type="file" id="image" name="image" class="m-3"><br>
                    <button type="submit" class="btn btn-primary" class="m-3">新規投稿する</button>
                    <a href="#" class="btn btn-secondary"onclick='window.history.back(-1);'>戻る</a>
                    <a href="/home" class="btn btn-secondary">ホームへ</a>
                </form>
            </div>
        </div>
    </div>
@endsection
