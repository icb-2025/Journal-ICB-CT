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
    Schema::create('aktivitas_siswas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('siswa_id')->constrained('users');
        $table->foreignId('perusahaan_id')->constrained('perusahaans');
        $table->date('tanggal');
        $table->string('status')->default('masuk');
        $table->time('mulai');
        $table->time('selesai');
        $table->text('deskripsi');
        $table->foreignId('kategori_tugas_id')->nullable()->constrained('kategori_tugas');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas_siswas');
    }
};