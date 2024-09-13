<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('taches', function (Blueprint $table) {
        $table->string('quantite')->change();
    });
}

public function down()
{
    Schema::table('taches', function (Blueprint $table) {
        $table->integer('quantite')->change();
    });
}
};
