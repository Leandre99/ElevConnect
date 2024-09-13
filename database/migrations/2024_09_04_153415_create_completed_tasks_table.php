<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompletedTasksTable extends Migration
{
    public function up()
    {
        Schema::create('completed_tasks', function (Blueprint $table) {
            $table->id();

            // Colonnes tache_id et task_id
            $table->unsignedBigInteger('tache_id');  // Pour la table taches
            $table->unsignedBigInteger('task_id')->nullable(); // Au cas où task_id est utilisé
            $table->unsignedBigInteger('user_id');   // Pour la table users

            // Timestamp pour marquer la tâche comme complétée
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            // Foreign key pour tache_id
            $table->foreign('tache_id')->references('id')->on('taches')->onDelete('cascade');

            // Foreign key pour task_id (si utilisé)
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');

            // Foreign key pour user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('completed_tasks');
    }
}
