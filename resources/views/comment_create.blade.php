@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
        <div class="col-md-8 text-center p-5">
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
               コメントを書く<br>
                <textarea name="comment" class="m-3"></textarea><br>
                <input type="hidden" value="{{ $post }}" id="" name="posts_id">
                <button type="submit" class="btn btn-primary" class="m-3">コメントする</button>
                <a href="#" class="btn btn-secondary"onclick='window.history.back(-1);'>戻る</a>
            </form>
        </div>
        
    </div>
@endsection