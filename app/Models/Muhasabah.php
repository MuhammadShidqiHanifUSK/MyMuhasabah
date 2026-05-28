<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Muhasabah extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'mood',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}