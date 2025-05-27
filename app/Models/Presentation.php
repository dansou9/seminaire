<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'date_evenement',
        'resume',
        'etat',
        'pdf_file_path',
        'user_id',
    ];

    protected $casts = [
        'date_evenement' => 'datetime', // <--- Ajoute cette ligne
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
