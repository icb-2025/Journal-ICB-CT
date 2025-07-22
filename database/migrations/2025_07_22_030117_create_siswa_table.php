<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_siswa_table.php

public function up()
{
    Schema::create('siswa', function (Blueprint $table) {
        $table->id();
        $table->string('nama_lengkap');
        $table->string('nis')->unique();
        $table->string('tempat_lahir');
        $table->date('tanggal_lahir');
        $table->string('gol_darah')->nullable();
        $table->string('sekolah');
        $table->text('alamat_sekolah');
        $table->string('telepon_sekolah')->nullable();
        $table->string('nama_wali');
        $table->text('alamat_wali');
        $table->string('telepon_wali')->nullable();
        $table->unsignedBigInteger('input_by'); // user_id dari guru
        $table->timestamps();

        // Relasi ke tabel users (guru)
        $table->foreign('input_by')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
