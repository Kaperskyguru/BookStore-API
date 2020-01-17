<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'ISBN',
        'description',
        'avg_review',
        'title',
      ];
      
    //describing a one-to-many-relationship between books and reviews
    public function review(){
      return $this->hasMany('App\Review');
    }
}
