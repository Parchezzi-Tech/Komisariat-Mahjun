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
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->unique();
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('alamat')->nullable();
            $table->string('fakultas')->nullable();
            $table->string('prodi')->nullable();
            $table->string('angkatan')->nullable();
            $table->enum('status', ['Aktif', 'Non-Aktif', 'Alumni'])->default('Aktif');
            $table->date('tanggal_masuk')->nullable();
            $table->string('foto')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
