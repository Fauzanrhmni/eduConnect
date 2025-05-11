<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserIdInForumsTable extends Migration
{
    /**
     * Menjalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forums', function (Blueprint $table) {
            // Hapus foreign key jika ada
            $table->dropForeign(['user_id']);

            // Menetapkan kolom user_id tidak boleh null
            $table->foreignId('user_id')->nullable(false)->change();

            // Menambahkan kembali foreign key dengan onDelete cascade
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Membatalkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forums', function (Blueprint $table) {
            // Menghapus foreign key
            $table->dropForeign(['user_id']);
        });
    }
}
