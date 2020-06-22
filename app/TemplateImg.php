<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateImg extends Model
{
    protected $fillable = [
        'TemplateID', 'ImgName','TheImg','dst_x','dst_y','src_x','src_y','dst_w','dst_h','src_w','src_h'
    ];
   public function Template() {
    return $this->belongsTo('Template');
   }
}
