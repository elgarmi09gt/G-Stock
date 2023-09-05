<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSortie
 */
class Sortie extends Model
{
    use HasFactory;

    protected $fillable = [
        'vente_id', 'produit_id', 'prix', 'quantite', 'user_id'
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
