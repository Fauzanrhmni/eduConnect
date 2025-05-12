<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLinkColumnToMentoringDiskusiForumTables extends Migration
{
    public function up()
    {
        Schema::table('mentorings', function (Blueprint $table) {
            $table->string('link')->nullable()->after('deskripsi');
        });

        Schema::table('diskusis', function (Blueprint $table) {
            $table->string('link')->nullable()->after('deskripsi');
        });

        Schema::table('forums', function (Blueprint $table) {
            $table->string('link')->nullable()->after('deskripsi');
        });
    }

    public function down()
    {
        Schema::table('mentorings', function (Blueprint $table) {
            $table->dropColumn('link');
        });

        Schema::table('diskusis', function (Blueprint $table) {
            $table->dropColumn('link');
        });

        Schema::table('forums', function (Blueprint $table) {
            $table->dropColumn('link');
        });
    }
}
