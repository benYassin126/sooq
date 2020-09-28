<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    protected $fillable = [
        'TheImg', 'UserID','ImgType','ImgPrice','ImgLPrice','ImgMPrice','ImgSPrice','ImgSection','ImgName','ShowName'
    ];
   public function User() {
    return $this->belongsTo('User','id');
   }
}
