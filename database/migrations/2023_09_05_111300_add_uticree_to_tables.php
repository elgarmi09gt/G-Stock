<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $tables = [
        'produits', 'clients', 'ventes', 'entrees', 'sorties', 'comptes', 'reglements'
    ];
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach ($this->tables as $t) {
            Schema::table($t, function (Blueprint $table) {
                $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->tables as $t) {
            Schema::table($t, function (Blueprint $table) {
                $table->dropConstrainedForeignIdFor(User::class);
            });
        }
    }
};
