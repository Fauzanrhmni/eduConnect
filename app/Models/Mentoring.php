<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'user_id', // Pastikan sudah disesuaikan dengan user yang mengelola forum
        'keahlian',
        'total_peserta',
        'is_favorit',
        'status',
        'link',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     // Relasi Many-to-Many dengan User (Favorit Forum)
    public function favoritOleh()
    {
        return $this->belongsToMany(User::class, 'favorit_mentorings', 'mentoring_id', 'user_id')->withTimestamps();
    }

}
