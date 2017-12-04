<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';
    public $timestamps = false;
    protected $fillable = ['title','description'];

    public function posts(){
            return $this->hasMany('App\Post','topic','id');
    }
}
