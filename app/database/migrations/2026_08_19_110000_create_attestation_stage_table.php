<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
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

            $table->foreign('idDemande')
                ->references('idDemande')
                ->on('demande_stage')
                ->onDelete('cascade');

            $table->unique('idDemande');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attestation_stage');
    }
};
