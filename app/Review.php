<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'comment',
        'book_id',
        'user_id',
      ];
      
    //describing a one-to-many-relationship between users and reviews
    public function user(){
      return $this->belongsTo('App\User');
    }

    //describing a one-to-many-relationship between books and reviews
    public function book(){
        return $this->belongsTo('App\Book');
    }
}
