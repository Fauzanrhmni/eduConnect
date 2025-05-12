<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeskripsiToForumsTable extends Migration
{
    public function up()
    {
        Schema::table('forums', function (Blueprint $table) {
            // Menambahkan kolom deskripsi
            $table->text('deskripsi')->nullable()->after('kategori_forum');
        });
    }

    public function down()
    {
        Schema::table('forums', function (Blueprint $table) {
            // Menghapus kolom deskripsi jika migrasi dibatalkan
            $table->dropColumn('deskripsi');
        });
    }
}