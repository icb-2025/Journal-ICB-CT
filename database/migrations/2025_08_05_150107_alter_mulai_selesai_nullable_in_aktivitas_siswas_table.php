<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('aktivitas_siswas', function (Blueprint $table) {
            $table->time('mulai')->nullable()->change();
            $table->time('selesai')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('aktivitas_siswas', function (Blueprint $table) {
            $table->time('mulai')->nullable(false)->change();
            $table->time('selesai')->nullable(false)->change();
        });
    }
};

