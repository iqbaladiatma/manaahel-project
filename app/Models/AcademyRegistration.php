<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcademyRegistration extends Model
{
    protected $fillable = [
        'academy_program_id',
        'user_id',
        'name',
        'email',
        'phone',
        'notes',
        'status',
        'whatsapp_group_link',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'string',
        ];
    }

    public function academyProgram(): BelongsTo
    {
        return $this->belongsTo(AcademyProgram::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
