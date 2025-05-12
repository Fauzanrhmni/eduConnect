<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use League\CommonMark\Extension\Mention\Mention;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'image',
        'keahlian_jurusan',
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

    // Ubah ke relasi belongsToMany untuk relasi many-to-many
    public function favoritForums()
    {
        return $this->belongsToMany(Forum::class, 'favorit_forums', 'user_id', 'forum_id')->withTimestamps();
    }
    
    public function favoritDiskusis()
    {
        return $this->belongsToMany(Diskusi::class, 'favorit_diskusis', 'user_id', 'diskusi_id')->withTimestamps();
    }

    public function favoritMentorings()
    {
        return $this->belongsToMany(Mentoring::class, 'favorit_mentorings', 'user_id', 'mentoring_id')->withTimestamps();
    }

}
