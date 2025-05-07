<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('diagnostics', function (Blueprint $table) {
            $table->string('nom_autre_maladie')->nullable();
            $table->text('symptomes_autre')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('diagnostics', function (Blueprint $table) {
            //
        });
    }
};
