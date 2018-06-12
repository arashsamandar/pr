<?php

namespace App;

use Faker\Provider\DateTime;
use Faker\Provider\Image;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    protected $table = "users";

    public function logs() {
        return $this->hasMany('App\Logs');
    }

    public function userImages() {
        return $this->hasMany('App\UserImages');
    }

    protected $fillable = [
        'name', 'family','national_code','gender','birth_date','username','password',
        'cell_phone','email','created_at_shamsi',
    ];

     protected $hidden = [
        'password', 'remember_token',
     ];


    static function check_if_user_matches($user) {
//        $all_users = User::all();
//        $myarray = [];
        $myuser = \DB::table('users')->where('username', $user)->first();
            if($myuser === $user) {
                $userid = \DB::table('users')->where('username', $myuser)->first();
                $myarray['usname'] = $myuser;
                $myarray['usid'] = $userid;
                return $myarray;
            } else {
                return null;
            }
    }
}
