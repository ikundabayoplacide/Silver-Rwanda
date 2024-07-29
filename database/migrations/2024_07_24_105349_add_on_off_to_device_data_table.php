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
            $table->boolean('on_off')->default(true)->after('device_state');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('device_data', function (Blueprint $table) {
            $table->dropColumn('on_off');
        });
    }
};
