<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistantClinicRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_id',
        'assistant_id'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'clinic_id',
        'assistant_id'
    ];


}
