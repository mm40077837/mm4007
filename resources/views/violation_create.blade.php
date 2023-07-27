@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 text-center p-5">
        <form action="{{ route('violation.store') }}" method="POST">
            @csrf
            違反報告する<br>
            <textarea name="violation" class="m-3"></textarea><br>
            <input type="hidden" value="{{ $id }}" id="" name="posts_id">
            <button type="submit" class="btn btn-primary" class="m-3">報告する</button>
            <a href="#" class="btn btn-secondary"onclick='window.history.back(-1);'>戻る</a>
        </form>
    </div>
</div>
@endsection

