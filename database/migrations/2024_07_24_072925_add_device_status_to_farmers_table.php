<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('device_data', function (Blueprint $table) {
            $table->integer('device_state')->default(3)->after('A_HUM');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('device_data', function (Blueprint $table) {
        $table->dropColumn('device_state');
        });
    }
};
