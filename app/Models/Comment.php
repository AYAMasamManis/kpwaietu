<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes; // <<< TAMBAHKAN BARIS INI

class Comment extends Model
{
    use SoftDeletes; // <<< TAMBAHKAN BARIS INI

    protected $fillable = ['user_id', 'parent_id', 'content', 'gambar']; 
    // Relasi ke user yang membuat komentar
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke komentar induk (jika ini balasan)
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Relasi ke balasan-balasan dari komentar ini
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id')->orderBy('created_at', 'asc');
    }

    // Relasi ke likes untuk komentar ini
    public function likes(): HasMany
    {
        return $this->hasMany(CommentLike::class);
    }

    // Cek apakah user saat ini sudah like komentar ini
    public function isLikedByUser(?User $user): bool
    {
        return $user ? $this->likes()->where('user_id', $user->id)->exists() : false;
    }
}