
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('candidat', function (Blueprint $table) {

            if (!Schema::hasColumn('candidat', 'cne')) {
                $table->string('cne', 50)->nullable()->after('cin');
            }

            if (!Schema::hasColumn('candidat', 'dateNaissance')) {
                $table->date('dateNaissance')->nullable();
            }

            if (!Schema::hasColumn('candidat', 'adresse')) {
                $table->string('adresse', 255)->nullable();
            }

            if (!Schema::hasColumn('candidat', 'anneeUniversitaire')) {
                $table->string('anneeUniversitaire', 20)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('candidat', function (Blueprint $table) {

            if (Schema::hasColumn('candidat', 'cne')) {
                $table->dropColumn('cne');
            }

            if (Schema::hasColumn('candidat', 'dateNaissance')) {
                $table->dropColumn('dateNaissance');
            }

            if (Schema::hasColumn('candidat', 'adresse')) {
                $table->dropColumn('adresse');
            }

            if (Schema::hasColumn('candidat', 'anneeUniversitaire')) {
                $table->dropColumn('anneeUniversitaire');
            }
        });
    }
};

