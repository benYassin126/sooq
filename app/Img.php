<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
   public function User() {
    return $this->belongsTo('User','id');
   }
}
