<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'company',
        'location',
        'period',
        'description',
        'achievements',
        'technologies',
        'is_current',
        'sort_order',
    ];

    protected $casts = [
        'achievements' => 'array',
        'technologies' => 'array',
        'is_current' => 'boolean',
        'sort_order' => 'integer',
    ];
}
