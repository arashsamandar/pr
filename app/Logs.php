<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'logDate','logTime','logCode','user_id','log_desc','Reserved1','Reserved2'
    ];

    public function users() {
        return $this->belongsTo('App\User','user_id','id');
    }
}
