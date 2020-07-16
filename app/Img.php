<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    protected $fillable = [
        'TheImg', 'UserID','ImgType'
    ];
   public function User() {
    return $this->belongsTo('User','id');
   }
}
