<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageTwo extends Model
{
    public $timestamps = false;

    protected $fillable = ['id','content_id','user_id','imagetwo'];

    public function content() {
        return $this->belongsTo('App\Content','content_id','id');
    }

    public function users() {
        return $this->belongsTo('App\User','user_id','id');
    }


}
