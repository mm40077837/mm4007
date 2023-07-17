@extends('layouts.app')

@section('content')
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
                    <th scope='col' class="p-3">{{ $post['title'] }}</th> <!--★詳細画面へ遷移-->   
                    <th scope='col' class="pr-3">{{ $post['user']['name'] }}</th>
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
                        @endif<br>
                        違反報告件数:{{ $post['violation_count'] }}<br>
                        <form action="{{ route('admin.logicaldelete', $post['id']) }}" method="get" onclick='return confirm("本当に表示停止しますか？");'> <!--★userの管理画面ページへ遷移-->
                                <button type="submit" class="btn btn-danger text-nowrap">表示停止</button>
                        </form>
                    </th>
                </tr>
            </table>
        @endforeach
    </div>
</div>
@endsection


