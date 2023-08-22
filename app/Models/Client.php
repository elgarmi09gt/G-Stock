<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperClient
 */
class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'prenoms',
        'nom',
        'telephone'
    ];
}
