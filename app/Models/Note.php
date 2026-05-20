<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    // Mengizinkan kolom berikut diisi secara massal saat form disimpan
    protected $fillable = [
        'user_id', 
        'folder_id', 
        'title', 
        'content'
    ];

    /**
     * Relasi balik: Catatan ini milik seorang User (Banyak Catatan ke Satu User)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi balik: Catatan ini bisa termasuk dalam sebuah Folder (Banyak Catatan ke Satu Folder)
     */
    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }
}