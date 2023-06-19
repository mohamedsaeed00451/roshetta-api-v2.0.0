<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'governorate_id',
        'account_isActive',
        'account_enable',
        'account_run',
        'logo',
        'serial',
        'start_working',
        'end_working',
        'address',
        'owner_id',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'governorate_id',
        'owner_id'
    ];
}
