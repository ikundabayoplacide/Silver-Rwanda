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
        Schema::create('farmers', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name", 255);
            $table->string("email", 255);
            $table->string("phone", 255);
            $table->string("district", 512);
            $table->string("password", 512);
            $table->string('cooperative_id')->nullable();
            $table->timestamps();
            $table->foreign('farmer_id')
            ->references('id')
            ->on('farmers')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmers');
    }
};
