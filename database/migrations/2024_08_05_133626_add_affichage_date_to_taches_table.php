<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('taches', function (Blueprint $table) {
            $table->date('affichage_date')->nullable()->after('ferme_id');
        });
    }


    public function down(): void
    {
        Schema::table('taches', function (Blueprint $table) {
            $table->dropColumn('affichage_date');
        });
    }
};
