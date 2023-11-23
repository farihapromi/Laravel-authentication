<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    //first approved process
    protected function type(): Attribute
    {
        return new Attribute(
            get: fn($value) => ["user", "admin", "superadmin"][$value],
        );
    }

    //custom user check
    // Custom function to check user types
    public function isAdmin(): bool
    {
        return $this->type === 'admin';
    }

    public function isSuperAdmin(): bool
    {
        return $this->type === 'superadmin';
    }

    // Define relationship between User and Posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
