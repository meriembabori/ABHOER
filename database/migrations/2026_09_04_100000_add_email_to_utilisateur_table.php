<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('utilisateur', function (Blueprint $table) {
            $table->string('email', 150)
                ->nullable()
                ->unique()
                ->after('login');
        });

        /**
         * Rétro-remplissage : pour les comptes étudiants déjà
         * existants (liés à un candidat), on récupère l'email
         * déjà saisi lors de l'inscription, afin qu'ils puissent
         * se connecter avec leur email dès maintenant.
         */
        DB::statement(
            'UPDATE utilisateur u
             INNER JOIN candidat c ON c.idCandidat = u.idCandidat
             SET u.email = c.email
             WHERE u.idCandidat IS NOT NULL
               AND c.email IS NOT NULL'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('utilisateur', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
};
