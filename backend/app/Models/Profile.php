<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'title',
        'bio',
        'avatar',
        'location',
        'cv_url',
        'about_me_text',
        'experience_years',
        'happy_clients',
        'projects_completed',
        'technologies_count',
        'available_for_hire',
    ];

    protected $casts = [
        'available_for_hire' => 'boolean',
        'experience_years' => 'integer',
        'happy_clients' => 'integer',
        'projects_completed' => 'integer',
        'technologies_count' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
