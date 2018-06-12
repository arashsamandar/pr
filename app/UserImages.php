<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserImages extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id','image'];

    public function users() {
        return $this->belongsTo('App\User','user_id','id');
    }

    static function selectuserimage($userid) {

        $user_has_image = UserImages::find($userid);
        if ($user_has_image) {
            return $image = \DB::table('user_images')->select('image')->where('user_id','=',$userid)->first()->image;
        }
        else {
            return false;
        }
    }
}
