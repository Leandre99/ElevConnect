<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('espece_id')->constrained()->onDelete('cascade');
            $table->foreignId('race_id')->constrained()->onDelete('cascade');
            $table->integer('age');
            $table->integer('nombre');
            $table->foreignId('ferme_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('animals');
    }
};
