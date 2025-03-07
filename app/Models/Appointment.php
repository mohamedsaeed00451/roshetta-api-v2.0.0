<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'status',
        'patient_id',
        'clinic_id'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'patient_id',
        'clinic_id'
    ];

    public function appointmentClinic()
    {
        return $this->belongsTo(Clinic::class,'clinic_id');
    }

    public function appointmentPatient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

}
