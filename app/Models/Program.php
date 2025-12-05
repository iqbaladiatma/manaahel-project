<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Program extends Model
{
    use HasFactory, HasTranslations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'type',
        'delivery_type',
        'status',
        'description',
        'syllabus',
        'meeting_link',
        'fees',
        'start_date',
        'end_date',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array<string>
     */
    public $translatable = ['name', 'description', 'syllabus'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'fees' => 'decimal:2',
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    /**
     * Get the registrations for the program.
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Get the courses for the program.
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class)->orderBy('order');
    }

    /**
     * Get the schedules for the program.
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(ProgramSchedule::class)->orderBy('scheduled_at');
    }

    /**
     * Scope a query to only include active programs.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope a query to filter programs by type.
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }
}
