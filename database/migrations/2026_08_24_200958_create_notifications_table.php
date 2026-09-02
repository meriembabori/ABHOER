<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('idNotification');

            $table->integer('idUtilisateur');

            $table->string('titre');
            $table->text('message');

            $table->string('type')->default('INFO');

            $table->boolean('lu')->default(false);

            $table->integer('idDemande')->nullable();

            $table->timestamps();

            $table->foreign('idUtilisateur')
                ->references('idUtilisateur')
                ->on('utilisateur')
                ->onDelete('cascade');

            $table->foreign('idDemande')
                ->references('idDemande')
                ->on('demande_stage')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};