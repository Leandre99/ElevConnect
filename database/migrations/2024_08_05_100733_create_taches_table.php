<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('taches', function (Blueprint $table) {
            $table->id();
            $table->string('nomtache');
            $table->foreignId('race_id')->constrained('races');
            $table->string('quantite');
            $table->string('type');
            $table->foreignId('user_id')->constrained('users');
            $table->boolean('status')->default(0);
            $table->foreignId('ferme_id')->constrained('fermes');
            $table->foreignId('task_id')->constrained('tasks');
            $table->date('affichage_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('taches');
    }
};
