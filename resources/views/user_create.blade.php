@extends('layouts.app')

@section('content')
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf<!--外部アクセス禁止-->
        <input type="file" id="icon" name="icon">
        <button type="submit" class="btn btn-primary">アイコンを追加する</button>
    </form>
    <div class="text-right">
    <a href="#" class="btn btn-secondary"onclick='window.history.back(-1);'>戻る</a>
</div>
@endsection