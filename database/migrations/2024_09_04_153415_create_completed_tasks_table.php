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

            $table->unsignedBigInteger('tache_id');
            $table->unsignedBigInteger('task_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ferme_id')->nullable();
            $table->string('nomtache')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->foreign('tache_id')->references('id')->on('taches')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ferme_id')->references('id')->on('fermes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('completed_tasks');
    }
}
