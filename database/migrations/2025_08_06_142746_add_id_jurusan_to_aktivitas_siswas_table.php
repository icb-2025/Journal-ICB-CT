<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('aktivitas_siswas', function (Blueprint $table) {
        $table->unsignedBigInteger('id_jurusan')->nullable()->after('siswa_id');

        $table->foreign('id_jurusan')->references('id')->on('jurusans')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('aktivitas_siswas', function (Blueprint $table) {
        $table->dropForeign(['id_jurusan']);
        $table->dropColumn('id_jurusan');
    });
}

};
