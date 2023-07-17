@extends('layouts.app')

@section('content')
<div class="text-center">

<!--アカウント編集時のバリデーション-->
<div class="">  
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
            <form action="{{ route('users.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
            @method('patch')
                <!--enctype="multipart/form-data" をformに入れないとファイルは登録されない--> 
                @csrf<!--外部アクセス拒否-->
                アイコン: <input type="file" class="my-3" id="icon" name="icon" value="{{ old('icon', Auth::user()->icon) }}"><br>
                氏名:<input type="text"  class="my-3" name="name" placeholder="氏名" value="{{ old('name', Auth::user()->name) }}"><br>
                メールアドレス:<input type="text"  class="my-3" name="email" placeholder="メールアドレス" value="{{ old('email', Auth::user()->email) }}"><br>
                <button type="submit" class="btn btn-primary">アカウントを編集する</button>
                <a href="#" class="btn btn-secondary"onclick='window.history.back(-1);'>戻る</a>
                <a href="/home" class="btn btn-secondary">ホームへ</a>
            </form>
        </div>
    </div>
</div>
@endsection

