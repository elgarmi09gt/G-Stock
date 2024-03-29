<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperVente
 */
class Vente extends Model
{
    use HasFactory;

    protected $fillable = [
        'etat', 'mois', 'reference', 'client_id', 'user_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function reglement()
    {
        return $this->hasOne(Reglement::class);
    }
}
