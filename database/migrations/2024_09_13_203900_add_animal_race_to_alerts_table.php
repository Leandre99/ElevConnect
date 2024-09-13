<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('alerts', function (Blueprint $table) {
            $table->string('animal_race')->nullable(); // Ajoute le champ pour la race de l'animal
        });
    }

    public function down()
    {
        Schema::table('alerts', function (Blueprint $table) {
            $table->dropColumn('animal_race');
        });
    }

};
