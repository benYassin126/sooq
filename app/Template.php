<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = [
        'TemplateName', 'TemplateBackGround',
    ];
   public function TemplateImgs() {
    return $this->hasMany('TemplateImg','TemplateID');
   }

   public function Pakages() {
    return $this->belongsToMany('Pakage','template_pakage','TemplateID','PakageID');
   }
}
