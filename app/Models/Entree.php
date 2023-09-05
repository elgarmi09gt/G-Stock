<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperEntree
 */
class Entree extends Model
{
    use HasFactory;

    protected $fillable = [
        'produit_id', 'quantite', 'prix', 'user_id'
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
