<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function like_exist($users_id, $posts_id) {        
        return Like::where('users_id', $users_id)->where('posts_id', $posts_id)->exists();       
        }
}
