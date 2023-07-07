@extends('layouts.app')

@section('content')
<div class="container">

<!--アカウント編集時のバリデーション-->
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
        <div class="col-md-8">
            <form action="{{ route('users.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
            @method('patch')
                <!--enctype="multipart/form-data" をformに入れないとファイルは登録されない--> 
                @csrf<!--外部アクセス拒否-->
                <input type="file" id="icon" name="icon" value="{{ old('icon', Auth::user()->icon) }}"><br>
                <input type="text" name="name" placeholder="氏名" value="{{ old('name', Auth::user()->name) }}"><br>
                <input type="text" name="email" placeholder="メールアドレス" value="{{ old('email', Auth::user()->email) }}"><br>
                <button type="submit" class="btn btn-primary">アカウントを編集する</button>
            </form>
        </div>
    </div>
</div>

<div class="text-right">
    <a href="#" class="btn btn-secondary"onclick='window.history.back(-1);'>戻る</a>
</div>
@endsection

