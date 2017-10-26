<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }

    public function symptoms()
    {
        return $this->hasMany('App\Symptom');
    }
}

//class Patient extends Model
//{
//    //
//    public function user()
//    {
//        return $this->belongsTo('App\User');
//    }
//
//    public function sessions()
//    {
//        return $this->hasMany('App\Session');
//    }

//    public function symptoms()
//    {
//        return $this->hasMany('App\Symptom');
//    }
//
//    public function medicines()
//    {
//        return $this->hasMany('App\Medicine');
//    }
//
//    public function tests()
//    {
//        return $this->hasMany('App\Test');
//    }
//
//    public function returndates()
//    {
//        return $this->hasMany('App\ReturnDate');
//    }
//
//    public function extra_advices()
//    {
//        return $this->hasMany('App\Extra_advice');
//    }
//}
