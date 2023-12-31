<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\HasMany;

class Post extends Model
{
    protected $fillable=['id','post','image','users_id','title','date','del_flg']; 
    
    protected $table='posts';

     public function user(){
        return $this->belongsTo('App\User', 'users_id', 'id');
    }

    public function violation(){
        return $this->hasMany('App\Violation','posts_id', 'id');
    }

    public function likes(){
        return $this->hasMany('App\Like','posts_id','id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany('App\Comment');
    }
}
