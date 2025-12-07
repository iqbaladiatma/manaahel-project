<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademyProgram extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'description',
        'details',
        'whatsapp_group_link',
        'price',
        'start_date',
        'end_date',
        'image',
        'is_active',
        'max_participants',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'price' => 'decimal:2',
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(AcademyRegistration::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
