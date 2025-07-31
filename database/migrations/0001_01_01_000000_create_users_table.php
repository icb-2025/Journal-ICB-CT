<!--0001_01_01_000000_create_users_table.php->

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('role')->default('siswa'); // hanya gunakan role
            // $table->string('nik', 20)->nullable()->after('role'); ini dari migration untuk menambahkan nik ke users
            // $table->string('nisn', 20)->nullable()->after('nik'); ini dari migration untuk menambahkan nik ke users
            // $table->string('nama_jurusan')->nullable()->after('role'); ini dari migration untuk menambahkan nik ke users
            // $table->string('kode_perusahaan')->nullable()->after('role'); ini dari migration untuk menambahkan nik ke users
            $table->unsignedBigInteger('input_by')->nullable(); // user id yang menginput
            $table->timestamp('input_date')->nullable(); // tanggal input
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
