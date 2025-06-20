<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'content']; // Ubah ke 'content' agar konsisten

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
