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

    protected $table='violations';

    public function user(){
        return $this->belongsTo('App\User','users_id', 'id');
    }

    public function post(){
        return $this->hasmany('App\Post','posts_id', 'id');
    }
}
