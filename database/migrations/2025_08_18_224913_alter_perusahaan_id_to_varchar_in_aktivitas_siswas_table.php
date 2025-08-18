<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ubah tipe kolom perusahaan_id menjadi string
        Schema::table('aktivitas_siswas', function (Blueprint $table) {
            $table->dropForeign(['perusahaan_id']); // hapus FK dulu
            $table->string('perusahaan_id')->change();
        });
    }

    public function down(): void
    {
        Schema::table('aktivitas_siswas', function (Blueprint $table) {
            $table->unsignedBigInteger('perusahaan_id')->change();
            $table->foreign('perusahaan_id')->references('id')->on('perusahaans');
        });
    }
};
