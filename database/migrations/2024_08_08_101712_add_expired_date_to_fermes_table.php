<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('fermes', function (Blueprint $table) {
            $table->date('expired_date')->nullable()->after('adresse');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fermes', function (Blueprint $table) {
            $table->dropColumn('expired_date');
        });
    }
};
