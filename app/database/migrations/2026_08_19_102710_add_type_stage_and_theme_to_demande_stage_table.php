<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajoute le type de stage (observation, technique, PFE...).
     * NB : la colonne "theme" est déjà créée par la migration
     * 2026_08_18_105841_add_theme_motivation_to_demande_stage_table.
     */
    public function up(): void
    {
        Schema::table('demande_stage', function (Blueprint $table) {
            $table->string('typeStage', 100)->nullable()->after('typeDepot');
        });
    }

    public function down(): void
    {
        Schema::table('demande_stage', function (Blueprint $table) {
            $table->dropColumn('typeStage');
        });
    }
};
