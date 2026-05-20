<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration untuk membuat tabel notes.
     */
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            // Menghubungkan catatan ke user pemiliknya
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Menghubungkan ke folder, dibuat nullable karena catatan bisa disimpan tanpa folder
            $table->foreignId('folder_id')->nullable()->constrained()->onDelete('set null');
            // Judul catatan
            $table->string('title');
            // Isi catatan (menggunakan text agar muat kode HTML tebal/miring dari editor teks kaya)
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Batalkan migration (hapus tabel notes).
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};