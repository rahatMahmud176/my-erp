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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('color')->default(true)->nullable();
            $table->boolean('size')->default(true)->nullable();
            $table->boolean('country')->default(true)->nullable();
            $table->boolean('sub_unit')->default(true)->nullable();
            $table->boolean('serial_number')->default(true)->nullable();
            $table->boolean('qty_manage_by_serial')->default(false)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
