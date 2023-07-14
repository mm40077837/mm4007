<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\HasMany;

class Post extends Model
{
    protected $fillable=['id','post','image','users_id','title','date']; 
    //DBに登録されるように許可させる
    protected $table='posts';
    //どこのテーブルに登録するかを示す

     public function user(){
        return $this->belongsTo('App\User', 'users_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany('App\Comment');
    }
}
