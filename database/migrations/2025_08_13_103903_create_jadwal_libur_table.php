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
    Schema::create('jadwal_libur', function (Blueprint $table) {
        $table->id();
        $table->foreignId('perusahaan_id')->constrained('perusahaans')->onDelete('cascade');
        $table->string('hari_libur'); // Senin - Minggu
        $table->string('status'); // Libur, Masuk, Libur Nasional
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_libur');
    }
};
