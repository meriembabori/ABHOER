<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('candidat', function (Blueprint $table) {
            if (!Schema::hasColumn('candidat', 'photo')) {
                $table->string('photo', 255)->nullable()->after('email');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidat', function (Blueprint $table) {
            if (Schema::hasColumn('candidat', 'photo')) {
                $table->dropColumn('photo');
            }
        });
    }
};
