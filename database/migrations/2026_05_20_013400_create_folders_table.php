<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration untuk membuat tabel folders.
     */
    public function up(): void
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->id();
            // Menghubungkan folder ke user yang membuatnya (jika user dihapus, folder ikut terhapus)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Nama folder catatan
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Batalkan migration (hapus tabel folders).
     */
    public function down(): void
    {
        Schema::dropIfExists('folders');
    }
};