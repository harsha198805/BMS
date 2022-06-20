<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded=[];
   // protected $fillable  = ['id','author_name','title','description','image','user_id','category_id'];

   public function tags(){
   	return $this->belongsToMany('App\Tag');
   }

   public function user(){
   	return $this->belongsTo('App\User');
   }

   public function category(){
   	return $this->belongsTo('App\Category');
   }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function getTagsIdArray(){
     $id_array=[];
     
     if(count($this->tags)){

      foreach ($this->tags as $tag) {
       $id_array[]=$tag->id;
      }

     }

     return $id_array;
    }
}
