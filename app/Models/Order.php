<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // Menggunakan \ (backslash)
use Illuminate\Database\Eloquent\Relations\HasMany; // Menggunakan \ (backslash)
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Menggunakan \ (backslash)
use Illuminate\Database\Eloquent\SoftDeletes; // Ini sudah benar

class Order extends Model
{
    use HasFactory, SoftDeletes; // Ini sudah benar

    protected $fillable = ['user_id', 'total_price', 'status', 'bukti_transfer', 'catatan_admin']; // <<< TAMBAHKAN 'bukti_transfer' DAN 'catatan_admin' DI SINI

    // protected $dates = ['deleted_at']; // Opsional untuk Laravel 9+

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
