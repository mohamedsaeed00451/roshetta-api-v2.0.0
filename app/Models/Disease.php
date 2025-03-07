<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'place',
        'patient_id',
        'doctor_id',
        'clinic_id'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'patient_id',
        'doctor_id',
        'clinic_id'
    ];
}
