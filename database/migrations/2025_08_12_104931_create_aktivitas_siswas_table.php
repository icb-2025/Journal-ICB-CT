<!-- 2025_08_06_120053_2025_07_24_143302_create_aktivitas_siswas_table.php.php -->

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aktivitas_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('users');
            $table->unique(['siswa_id', 'tanggal']);
            $table->unsignedBigInteger('id_jurusan')->nullable(); // ditambahkan di migrasi ini juga
            $table->foreign('id_jurusan')->references('id')->on('jurusans')->onDelete('set null');
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

    public function down(): void
    {
        Schema::dropIfExists('aktivitas_siswas');
    }
};
