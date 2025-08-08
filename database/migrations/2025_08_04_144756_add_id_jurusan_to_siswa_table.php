<!-- 2025_08_04_144756_add_id_jurusan_to_siswa_table.php -->

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
    $table->unsignedBigInteger('id_jurusan')->nullable()->after('kode_perusahaan');
    $table->foreign('id_jurusan')->references('id')->on('jurusans');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            //
        });
    }
};
