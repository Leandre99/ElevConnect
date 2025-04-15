<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('priority');
            $table->string('media')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('animal_race')->nullable();
            $table->foreignId('race_id')->nullable()->constrained('races')->after('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alerts');
    }
};
