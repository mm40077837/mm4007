@extends('layouts.app')

  <table class="table table-striped">
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
  <a href="#" class="btn btn-secondary" onclick='window.history.back(-1);'>戻る</a>

