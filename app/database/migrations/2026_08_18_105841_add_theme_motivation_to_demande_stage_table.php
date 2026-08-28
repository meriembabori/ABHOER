<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajouter les informations supplémentaires
     * à la demande de stage.
     */
    public function up(): void
    {
        Schema::table('demande_stage', function (Blueprint $table) {

            $table->string('theme', 255)
                ->nullable()
                ->after('dateFin');

            $table->text('motivation')
                ->nullable()
                ->after('theme');
        });
    }

    /**
     * Annuler les modifications.
     */
    public function down(): void
    {
        Schema::table('demande_stage', function (Blueprint $table) {

            $table->dropColumn([
                'theme',
                'motivation'
            ]);

        });
    }
};