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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique();
            $table->enum('jenis_surat', [
                'Surat Tugas',
                'Surat Keterangan',
                'Surat Undangan',
                'Surat Rekomendasi',
                'Surat Pengantar',
            ]);
            $table->string('perihal');
            $table->text('kepada');
            $table->text('isi_surat');
            $table->date('tanggal_surat');
            $table->string('penandatangan');
            $table->string('jabatan_penandatangan');
            $table->string('signature_path')->nullable(); // Path to signature image
            $table->enum('status', ['Draft', 'Final', 'Terkirim'])->default('Draft');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->string('pdf_path')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
