<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // The attributes that are mass assignable.
    // @var list<string>

    protected $fillable = [
        'username',
        'email',
        'password',
        'dob',
        'is_admin',
        'bio',
        'hobbies',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'hobbies' => 'array',
    ];

    // The attributes that should be hidden for serialization.
    // @var list<string>

    protected $hidden = [
        'password',
    ];

    // Get the attributes that should be cast.
    // @return array<string, string>

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'dob' => 'date',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Provide a `name` attribute for compatibility with views that expect `name`
    public function getNameAttribute()
    {
        return $this->attributes['username'] ?? null;
    }
}
