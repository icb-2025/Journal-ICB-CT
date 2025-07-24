<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeywordsToKategoriTugasTable extends Migration
{
    public function up(): void
    {
        Schema::table('kategori_tugas', function (Blueprint $table) {
            $table->text('keywords')->nullable()->after('deskripsi');
        });
    }

    public function down(): void
    {
        Schema::table('kategori_tugas', function (Blueprint $table) {
            $table->dropColumn('keywords');
        });
    }
}
