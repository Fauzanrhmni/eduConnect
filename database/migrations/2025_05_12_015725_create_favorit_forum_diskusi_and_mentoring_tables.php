<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel favorit_forums
        Schema::create('favorit_forums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('forum_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Tabel favorit_diskusis
        Schema::create('favorit_diskusis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('diskusi_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Tabel mentoring_diskusis
        Schema::create('favorit_mentorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentoring_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('pesan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorit_mentorings');
        Schema::dropIfExists('favorit_diskusis');
        Schema::dropIfExists('favorit_forums');
    }
};
