<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    protected $fillable=[
        'report',
        'posts_id',
        'users_id',
    ]; 
    //DBに登録されるように許可させる

    protected $table='violations';
    //どこのテーブルに登録するかを示す

    public function user(){
        return $this->belongsTo('App\User','users_id', 'id');
    }
    //ユーザテーブルのリレーション

    public function post(){
        return $this->hasmany('App\Post','posts_id', 'id');
    }
    //投稿テーブルのリレーション
}
