<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'batch_year',
        'position',
        'latitude',
        'longitude',
        'avatar_url',
        'instagram_url',
        'linkedin_url',
        'twitter_url',
        'facebook_url',
        'youtube_url',
        'tiktok_url',
        'bio',
        'city',
        'phone',
        'address',
        'date_of_birth',
        'gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
        ];
    }

    /**
     * Get the registrations for the user.
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Get the academy registrations for the user.
     */
    public function academyRegistrations(): HasMany
    {
        return $this->hasMany(AcademyRegistration::class);
    }

    /**
     * Check if user profile is complete for academy registration.
     */
    public function hasCompleteProfileForAcademy(): bool
    {
        return !empty($this->name) && !empty($this->email) && !empty($this->phone);
    }

    /**
     * Scope a query to only include members.
     */
    public function scopeMembers($query)
    {
        return $query->whereIn('role', ['user', 'member']);
    }

    /**
     * Scope a query to only include users with location.
     */
    public function scopeWithLocation($query)
    {
        return $query->whereNotNull('latitude')->whereNotNull('longitude');
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user is a member.
     */
    public function isMember(): bool
    {
        return in_array($this->role, ['user', 'member']);
    }

    /**
     * Check if the user is a member angkatan.
     */
    public function isMemberAngkatan(): bool
    {
        return $this->role === 'member_angkatan';
    }

    /**
     * Check if the user is a member program.
     */
    public function isMemberProgram(): bool
    {
        return $this->role === 'member_program';
    }

    /**
     * Get galleries uploaded by this user (for member angkatan).
     */
    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class, 'user_id');
    }

    /**
     * Get achievements for this user.
     */
    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class)->orderBy('order');
    }

    /**
     * Get articles authored by this user.
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    /**
     * Get programs created by this user.
     */
    public function createdPrograms(): HasMany
    {
        return $this->hasMany(Program::class, 'creator_id');
    }

    /**
     * Get courses created by this user.
     */
    public function createdCourses(): HasMany
    {
        return $this->hasMany(Course::class, 'creator_id');
    }

    /**
     * Get module progress for this user.
     */
    public function moduleProgress(): HasMany
    {
        return $this->hasMany(UserModuleProgress::class);
    }

    /**
     * Get attendances for this user.
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Scope a query to only include member angkatan.
     */
    public function scopeMemberAngkatan($query)
    {
        return $query->where('role', 'member_angkatan');
    }

    /**
     * Scope a query to only include member program.
     */
    public function scopeMemberProgram($query)
    {
        return $query->where('role', 'member_program');
    }

    /**
     * Check if the user has verified their email.
     */
    public function hasVerifiedEmail(): bool
    {
        return $this->email_verified_at !== null;
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\VerifyEmailNotification);
    }
}
