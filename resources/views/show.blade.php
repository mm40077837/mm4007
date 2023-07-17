@extends('layouts.app')

@section('content')
<div class="text-left" style="margin: auto; width: 500px;">
    <table class="table table-st riped p-5 mb-5" style="background-color: #008b8b;">
        <tr>
            <th>タイトル</th>
            <td>{{ $post['title'] }}</td>   
        </tr>
        <tr>
            <th>投稿者</th>
            <td>{{ $post['user']['name'] }}</td>   
        </tr>
        <tr>
            <th>投稿日</th>
            <td>{{ $post['date'] }}</td>
        </tr>
        <tr>
            <th>投稿</th>
            <td>{{ $post['post'] }}</td>
        </tr>
        <tr>
            <th>写真</th>
            <td>
                @if(empty($post['image']))
                 画像の投稿はありません
                @elseif(!empty($post['image']))
                <img src="{{ asset('storage/'.$post['image']) }}" style="width: 230px; height: 230px; object-fit: cover;">
                @endif
            </td>
        </tr>

        <tr>
            <th scope='col' class="pl-3 pb-3">
                <a href="{{ route('comments.create' ,['post'=>$post['id']] ) }}"><!--★コメント入力画面へ遷移-->
                    <button type="submit" class="btn text-white">💬:コメント</button>
                </a>
            </th>
            <th scope='col' class="pl-3 pb-3 text-white">
                @if($like_model->like_exist(Auth::user()->id,$post['id']))
                <p class="favorite-marke">
                <a class="js-like-toggle loved" href="" data-postid="{{ $post['id'] }}"><button type="button" class="like btn text-white">❤</button></a>
                <span class="likesCount">{{$post['likes_count']}}</span>
                </p>
                @else
                <p class="favorite-marke">
                <a class="js-like-toggle" href="" data-postid="{{ $post['id'] }}"><button type="button" class="like btn text-white">♡</button></a>
                <span class="likesCount">{{$post['likes_count']}}</span>
                </p>
                @endif​
            </th>
        </tr>
        @foreach($comment as $comments) 
        <tr>
            <th>  
                {{ $comments['user']['name'] }}<br>
                コメント : {{ $comments['comment']}}
            </th>
            <th>  
            <form action="{{ route('comments.destroy', $comments['id']) }}" method="post"><!--★コメント削除機能-->
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger text-nowrap" onclick='return confirm("本当にコメントを削除しますか？");'>削除</button>
            </form>
            </th>
        </tr>    
        @endforeach            
    </table>
    <div class="text-right">
        <table>
        <tr>
        <th><form action="{{ route('violation.create',['post'=>$post['id']]) }}" method="get"> <!--★違反報告ページへ遷移-->
            <button type="submit" class="btn btn-primary text-nowrap">違反報告ページへ</button>
        </form></th>
        <th><a href="#" class="btn btn-secondary"onclick='window.history.back(-1);'>戻る</a></th>
        <th><a href="/home" class="btn btn-secondary">ホームへ</a></th>
        </tr>
    </table>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
$(function () {
    var like = $('.js-like-toggle');
    var likePostId;
    
    like.on('click', function () {
        var $this = $(this);
        likePostId = $this.data('postid');
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/ajaxlike',  //routeの記述
                type: 'POST', //受け取り方法の記述（GETもある）
                data: {
                    'posts_id': likePostId //コントローラーに渡すパラメーター
                },
        })
    
            // Ajaxリクエストが成功した場合
           
            .done(function (data) {
                if(data.exist == null){
                    $('.like').html('♡');
                }else{
                    $('.like').html('❤');
                }
    //lovedクラスを追加
               
    
    //.likesCountの次の要素のhtmlを「data.postLikesCount」の値に書き換える
                $this.next('.likesCount').html(data.postLikesCount); 
    
            })
            // Ajaxリクエストが失敗した場合
            .fail(function (data, xhr, err) {
    //ここの処理はエラーが出た時にエラー内容をわかるようにしておく。
    //とりあえず下記のように記述しておけばエラー内容が詳しくわかります。笑
                console.log('エラー');
                console.log(err);
                console.log(xhr);
            });
        
        return false;
    });
    });
</script>

@endsection

