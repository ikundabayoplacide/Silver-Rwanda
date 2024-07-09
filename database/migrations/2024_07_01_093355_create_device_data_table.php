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
        // Check if the table already exists
        if (!Schema::hasTable('device_data')) {
            
            Schema::create('device_data', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('farmer_id')->nullable();
                $table->string('DEVICE_ID');
                $table->integer('S_HUM');
                $table->integer('S_TEMP');
                $table->integer('A_TEMP');
                $table->integer('A_HUM');
                $table->timestamps();
                $table->foreign('farmer_id')
                ->references('id')
                ->on('farmers')
                ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_data');
    }
};