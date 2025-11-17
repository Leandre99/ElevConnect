<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('completed_tasks', function (Blueprint $table) {
        $table->unsignedBigInteger('tache_id')->nullable()->change();
    });
}

public function down()
{
    Schema::table('completed_tasks', function (Blueprint $table) {
        $table->unsignedBigInteger('tache_id')->nullable(false)->change();
    });
}

};
