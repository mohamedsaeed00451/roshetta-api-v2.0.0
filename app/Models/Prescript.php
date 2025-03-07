<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescript extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial',
        'rediscovery_date',
        'patient_id',
        'doctor_id',
        'clinic_id',
        'disease_id'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'patient_id',
        'doctor_id',
        'clinic_id',
        'disease_id'
    ];
}
