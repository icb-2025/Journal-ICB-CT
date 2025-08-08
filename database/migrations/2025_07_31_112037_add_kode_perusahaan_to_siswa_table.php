<!-- 2025_07_31_112037_add_kode_perusahaan_to_siswa_table.php -->

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
    Schema::table('siswa', function (Blueprint $table) {
        $table->string('kode_perusahaan')->nullable()->after('telepon_wali');
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
