<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('attestation_stage')) {
            return;
        }

        Schema::create('attestation_stage', function (Blueprint $table) {
            $table->id('idAttestation');
            $table->unsignedBigInteger('idDemande');
            $table->string('statut', 30)->default('EN_PREPARATION');
            // EN_PREPARATION, PRETE, REMISE, REJETEE
            $table->date('datePreparation')->nullable();
            $table->date('dateDisponibilite')->nullable();
            $table->date('dateRemise')->nullable();
            $table->string('cheminFichier')->nullable();
            $table->text('observation')->nullable();
            $table->timestamps();

            // Pas de contrainte foreign key stricte : le type de idDemande
            // dans demande_stage (issu du dump SQL) peut différer légèrement
            // (int vs bigint unsigned) selon l'environnement. La relation
            // est garantie côté application par le modèle Eloquent Attestation.
            $table->unique('idDemande');
            $table->index('idDemande');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attestation_stage');
    }
};
