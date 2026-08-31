<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajoute idCandidat à utilisateur (lien vers le candidat pour les comptes ETUDIANT).
     */
    public function up(): void
    {
        Schema::table('utilisateur', function (Blueprint $table) {
            if (!Schema::hasColumn('utilisateur', 'idCandidat')) {
                $table->unsignedBigInteger('idCandidat')->nullable()->after('actif');
            }
        });
    }

    public function down(): void
    {
        Schema::table('utilisateur', function (Blueprint $table) {
            if (Schema::hasColumn('utilisateur', 'idCandidat')) {
                $table->dropColumn('idCandidat');
            }
        });
    }
};
