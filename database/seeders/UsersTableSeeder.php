<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeder untuk Mahasiswa
        User::create([
            'name' => 'Mahasiswa User',
            'email' => 'mahasiswa@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 1, // Mahasiswa
            'image' => 'mahasiswa_image.png',
            'keahlian_jurusan' => 'Teknik Informatika',
        ]);

        // Seeder untuk Mentor
        User::create([
            'name' => 'Mentor User',
            'email' => 'mentor@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 2, // Mentor
            'image' => 'mentor_image.png',
            'keahlian_jurusan' => 'Web Development',
        ]);
    }
}
