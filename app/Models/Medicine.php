<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicines',
        'prescript_id',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'medicines',
        'prescript_id',
    ];
}
