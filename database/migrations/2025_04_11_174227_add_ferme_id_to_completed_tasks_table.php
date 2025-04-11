<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('completed_tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('ferme_id')->after('user_id')->nullable();

            $table->foreign('ferme_id')
                ->references('id')
                ->on('fermes')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('completed_tasks', function (Blueprint $table) {
            $table->dropForeign(['ferme_id']);
            $table->dropColumn('ferme_id');
        });
    }
};
