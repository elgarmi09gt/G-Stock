<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperProduit
 */
class Produit extends Model
{
    use HasFactory;

    protected $fillable = ['reference','libelle','active'];
}
