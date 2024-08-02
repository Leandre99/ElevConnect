<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('tasks', function (Blueprint $table) {
        $table->string('frequence')->change(); // Change the column type to string
    });
}

public function down()
{
    Schema::table('tasks', function (Blueprint $table) {
        $table->integer('frequence')->change(); // Revert the column type if necessary
    });
}

};
