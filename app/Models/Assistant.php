<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Assistant extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ssd',
        'email',
        'phone',
        'gender_id',
        'birth_date',
        'governorate_id',
        'password',
        'email_isActive',
        'account_isActive',
        'account_enable',
        'account_run',
        'image',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'password',
        'birth_date',
        'gender_id',
        'governorate_id'
    ];

    public function gender()
    {
        return $this->belongsTo(Gender::class,'gender_id');
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class,'governorate_id');
    }

    public function clinicRequests()
    {
        return $this->hasMany(AssistantClinicRequest::class,'assistant_id');
    }

    public function clinics()
    {
        return $this->hasMany(Clinic::class,'assistant_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
