<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\post;
class category extends Model
{
    protected $fillable=['name'];
    /*dynamic proprety not a method */
    public function posts(){

            return $this->hasMany('App\post');
          // return $this->hasMany(post::class);

    }
}
