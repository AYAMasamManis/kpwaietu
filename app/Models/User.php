<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes; // <<< TAMBAHKAN BARIS INI

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes; // <<< TAMBAHKAN SoftDeletes DI SINI

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Pastikan 'role' ada di fillable untuk mass assignment
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

    // Relasi ke pesanan yang dibuat user
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    // Relasi ke komentar yang dibuat user
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // Relasi ke komentar yang dilike oleh user ini
    public function likedComments(): BelongsToMany
    {
        return $this->belongsToMany(Comment::class, 'comment_likes')->withTimestamps();
    }
}
