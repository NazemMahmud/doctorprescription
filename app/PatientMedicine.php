<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientMedicine extends Model
{
    protected $fillable = [
        'patient_id', 'session_id', 'medicine_id', 'medicine_name', 'MedicineDose', 'MedicineDuration', 'before_after_meal',
    ];
//    protected $fillable = ['name', 'mobile', 'email', 'address', 'created_at', 'updated_at'];

    protected $table = 'patient_medicines';
//    protected $hidden = [
//        'password', 'remember_token',
//    ];
}
