@extends('layouts.app')

@section('content')
<div class="text-left w-25" style="margin: auto;">
    <table class="table table-st riped p-5 mb-5 bg-info" >
        <tr>
            <th>タイトル</th>
            <td>{{ $post->title }}</td>
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
            <td>{{ $post->image }}</td>
        </tr>
    </table>
    <div class="text-right">
        <a href="#" class="btn btn-secondary"onclick='window.history.back(-1);'>戻る</a>
    </div>
</div>
@endsection

