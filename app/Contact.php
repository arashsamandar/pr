<?php

namespace laravel;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    public $timestamps = false;

    protected $fillable = ['name','family', 'cell_phone'];

    public static function scopeSearch($query,$s) {
        return $query->where('name','like','%' . $s . '%')
            ->orWhere('family','like','%' . $s . '%')
            ->orWhere('phone','like','%' . $s . '%');
    }
}
