<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'governorate_id',
        'specialist_id',
        'account_isActive',
        'account_enable',
        'account_run',
        'logo',
        'serial',
        'price',
        'start_working',
        'end_working',
        'address',
        'owner_id',
        'assistant_id'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'specialist_id',
        'governorate_id',
        'owner_id',
        'assistant_id'
    ];

    public function specialist()
    {
        return $this->belongsTo(Specialist::class,'specialist_id');
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class,'governorate_id');
    }

    public function assistant()
    {
        return $this->belongsTo(Assistant::class,'assistant_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'owner_id');
    }

    public function clinicRequests()
    {
        return $this->hasMany(AssistantClinicRequest::class,'clinic_id');
    }


}
