<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateImg extends Model
{
    protected $fillable = [
        'TemplateID', 'ImgName','TheImg','Blurry','ImgType','TextX','TextY','PriceX','PriceY'
    ];
   public function Template() {
    return $this->belongsTo('Template');
   }
}
