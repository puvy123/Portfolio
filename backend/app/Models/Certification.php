<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'organization',
        'credential_id',
        'issue_date',
        'expiration_date',
        'credential_url',
        'image',
        'sort_order',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiration_date' => 'date',
        'sort_order' => 'integer',
    ];
}
