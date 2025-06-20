<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'role_id',
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
        ];
    }

    public function courses()
    {
        // For students: courses they are registered in
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id');
    }

    public function teachingCourses()
    {
        // For faculty: courses they teach
        return $this->hasMany(Course::class, 'user_id');
    }

    public function submissions()
    {
        // For students: submissions they made
        return $this->hasMany(Submission::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
