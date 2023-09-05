<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reglement extends Model
{
    use HasFactory;

    protected $fillable = [
        'vente_id', 'verse', 'restant', 'user_id'
    ];

    public function vente()
    {
        return $this->belongsTo(Vente::class);
    }
}
