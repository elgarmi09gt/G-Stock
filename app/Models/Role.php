<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperRole
 */
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle', 'niveau', 'user_id'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
