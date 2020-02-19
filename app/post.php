<?php

namespace App;
use\App\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\tag;
use App\user;
class post extends Model
{
    protected$fillable=['title','description','content','image','category_id','user_id'];
    use SoftDeletes;
    public function category(){
        return $this->belongsTo(Category::class);
   }
   public function tags()

       {
           return $this->belongsToMany(tag::class);
       }
public function hasTag($tagId){
    return in_array($tagId,$this->tags->pluck('id')->toArray());
}
public function user(){
    //return $this->belongsTo('App/user');
    return $this->belongsTo(user::class);
}
}
