<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('admin_logs', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('admin_id');
        $table->string('action');
        $table->string('model')->nullable();
        $table->integer('model_id')->nullable();
        $table->text('details')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('admin_logs');
}

};
