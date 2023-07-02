@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('Posts.store') }}" method="POST" enctype="multipart/form-data">
                <!--enctype="multipart/form-data" をformに入れないとファイルは登録されない--> 
                @csrf<!--外部からアクセスされないようにする-->
                <input type="text" name="title" placeholder="タイトル"><br>
                <input type="date" name="date" placeholder="0000/00/00"><br>
                <textarea name="post"></textarea><br>
                <input type="file" id="image" name="image">
                <button type="submit" class="btn btn-primary">投稿する</button>
            </form>
            
               
            
        </div>
    </div>
</div>
@endsection
