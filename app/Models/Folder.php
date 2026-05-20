<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Folder extends Model
{
    // Mengizinkan kolom berikut diisi secara massal
    protected $fillable = [
        'user_id', 
        'name'
    ];

    /**
     * Relasi balik: Folder ini milik seorang User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Satu Folder bisa menampung banyak Catatan
     */
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
}