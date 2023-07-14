<?php

namespace App;
use App\Post;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'posts_id',
        'users_id',
    ];

    protected $table='comments';

    public function user(){
        return $this->belongsTo('App\User','users_id', 'id');
    }

    public function post(){
        return $this->belongsTo('App\Post','posts_id', 'id');
    }
}
