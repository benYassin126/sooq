<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pakage extends Model
{
   public function Subscripes() {
        return $this->hasMany('Subscrip','PakageID');
   }

      public function Templates() {
    return $this->belongsToMany('Template','template_pakage','PakageID','TemplateID');
   }
}
