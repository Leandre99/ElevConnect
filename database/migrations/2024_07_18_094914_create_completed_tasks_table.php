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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('task_id')->constrained()->onDelete('cascade');
            $table->foreignId('ferme_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'task_id', 'ferme_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('completed_tasks');
    }
}

