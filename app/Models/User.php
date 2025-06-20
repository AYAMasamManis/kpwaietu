<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Order;
use App\Models\Forum;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke orders
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    // Relasi ke forum (komentar buatan user ini)
    public function forums(): HasMany
    {
        return $this->hasMany(Forum::class);
    }

    // ✅ Relasi ke forum yang dilike
    public function likedForums(): BelongsToMany
    {
        return $this->belongsToMany(Forum::class, 'likes')->withTimestamps();
    }
}
