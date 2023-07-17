@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ユーザid</th>
                <th>ユーザ名</th>
                <th>メールアドレス</th>
                <th>表示停止数</th>
            </tr>
        </thead>
        @foreach($a as $user)
        @if($user['admin'] != 1)
        <tbody>
        <tr>
            <td>{{ $user['id'] }}</td>
            <td>{{ $user['name'] }}</td>
            <td>{{ $user['email'] }}</td>
            <td>{{ $user['total_view_count'] }}</td>
        </tr>
        </tbody>
        @endif
        @endforeach
    </table>

@endsection