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

}
