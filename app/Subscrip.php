<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscrip extends Model
{
   public function Pakage() {
    return $this->belongsTo('Pakage','id');
   }

   public function User() {
    return $this->belongsTo('\App\User','id');
   }
}
