<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRaceIdToAlertsTable extends Migration
{
    public function up()
{
    Schema::table('alerts', function (Blueprint $table) {
        $table->foreignId('race_id')->nullable()->constrained('races')->after('user_id');
    });
}


    public function down()
    {
        Schema::table('alerts', function (Blueprint $table) {
            $table->dropForeign(['race_id']);
            $table->dropColumn('race_id');
        });
    }
}
