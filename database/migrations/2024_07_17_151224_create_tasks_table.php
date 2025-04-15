<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('nomtache');
            $table->unsignedBigInteger('race_id');
            $table->unsignedBigInteger('espece_id')->nullable();
            $table->string('frequence')->nullable();
            $table->string('quantite')->nullable();
            $table->string('type')->nullable();
            $table->integer('age_min')->nullable();
            $table->integer('age_max')->nullable();
            $table->integer('jour')->nullable();

            $table->timestamps();

            $table->foreign('race_id')->references('id')->on('races')->onDelete('cascade');
            $table->foreign('espece_id')->references('id')->on('especes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
