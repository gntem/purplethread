<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    
    protected $fillable = ['creator','topic','title','body','ttl'];

    public function topic(){
        return $this->belongsTo('App\Topic','topic','id');
    }
    
    public function creator(){
        return $this->belongsTo('App\User','creator','id');
    }
	
	public function comments(){
		return $this->hasMany('App\Comment','post','id');
	}
}
