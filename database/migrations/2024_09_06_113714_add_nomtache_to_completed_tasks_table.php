<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('completed_tasks', function (Blueprint $table) {
        $table->string('nomtache')->nullable();
    });
}

public function down()
{
    Schema::table('completed_tasks', function (Blueprint $table) {
        $table->dropColumn('nomtache');
    });
}

};
