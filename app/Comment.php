<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    
    protected $fillable = ['creator','post','body'];

    public function post(){
        return $this->belongsTo('App\Post','post','id');
    }
    
    public function creator(){
        return $this->belongsTo('App\User','creator','id');
    }
}
