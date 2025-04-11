<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('animal_id')->constrained();
            $table->foreignId('maladie_id')->constrained();
            $table->integer('nombre_cas')->default(1);
            $table->date('date_apparition');
            $table->enum('statut', ['suspecte', 'confirme', 'gueri']);
            $table->text('traitement')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnostics');
    }
};
