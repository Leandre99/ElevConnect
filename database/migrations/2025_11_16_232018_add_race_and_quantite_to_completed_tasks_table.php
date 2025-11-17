<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('completed_tasks', function (Blueprint $table) {
        $table->unsignedBigInteger('race_id')->nullable();
        $table->string('quantite')->nullable();

        $table->foreign('race_id')->references('id')->on('races')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('completed_tasks', function (Blueprint $table) {
        $table->dropForeign(['race_id']);
        $table->dropColumn(['race_id', 'quantite']);
    });
}

};
