<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTables extends Migration
{
    public function up(): void
    {
        // Tabel landing_total
        Schema::create('landing_total', function (Blueprint $table) {
            $table->id();
            $table->integer('total_mentor');
            $table->integer('total_forum');
            $table->integer('total_student');
            $table->timestamps();
        });

        // Tabel join_forums
        Schema::create('join_forums', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->enum('tipe', ['teman_belajar', 'mentor', 'pencarian_peluang']);
            $table->timestamps();
        });

        // Tabel diskusi_landing
        Schema::create('diskusi_landing', function (Blueprint $table) {
            $table->id();
            $table->string('icon');
            $table->string('judul');
            $table->string('sub_judul');
            $table->timestamps();
        });

        // Tabel forums
        Schema::create('forums', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori_forum');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('is_favorit')->default(0);
            $table->timestamps();
        });

        // Tabel diskusis
        Schema::create('diskusis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('jurusan');
            $table->boolean('is_favorit')->default(0);
            $table->timestamps();
        });

        // Tabel mentorings
        Schema::create('mentorings', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('keahlian');
            $table->integer('total_peserta');
            $table->boolean('is_favorit')->default(0);
            $table->string('jenis_mentoring');
            $table->enum('status', ['tersedia', 'penuh']);
            $table->timestamps();
        });

        // Tabel mentors (relasi ke tabel users)
        Schema::create('mentors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('landing_pages');
        Schema::dropIfExists('join_forums');
        Schema::dropIfExists('diskusi_landing');
        Schema::dropIfExists('forums');
        Schema::dropIfExists('diskusis');
        Schema::dropIfExists('mentorings');
        Schema::dropIfExists('mentors');
    }
}
