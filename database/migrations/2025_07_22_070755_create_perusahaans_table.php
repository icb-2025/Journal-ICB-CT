<!-- 2025_07_22_070755_create_perusahaans_table.php -->

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
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_perusahaan', 45)->unique();
            $table->string('nama_industri');
            $table->string('bidang_usaha');
            $table->text('alamat');
            $table->string('no_telepon')->nullable();
            $table->string('nama_direktur');
            $table->string('nama_pembimbing');
            $table->foreignId('input_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaans');
    }
};
