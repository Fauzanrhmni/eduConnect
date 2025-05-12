<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTables extends Migration
{
    public function up(): void
    {

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
            $table->enum('status', ['tersedia', 'penuh']);
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('forums');
        Schema::dropIfExists('diskusis');
        Schema::dropIfExists('mentorings');
    }
}
