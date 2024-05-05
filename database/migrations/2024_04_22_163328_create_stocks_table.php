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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade')->default(1);
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade')->default(1);
            $table->foreignId('color_id')->constrained('colors')->onDelete('cascade')->default(1);
            $table->foreignId('size_id')->constrained('sizes')->onDelete('cascade')->default(1);
            $table->foreignId('country_id')->constrained('country_variants')->onDelete('cascade')->default(1);
            $table->integer('unit_qty')->default(1);
            $table->integer('sub_unit_qty')->default(0);
            $table->float('purchase_price', 10,2)->nullable();
            $table->float('wholesale_price', 10,2)->nullable();
            $table->float('price', 10,2)->nullable();
            $table->integer('branch_id');
            $table->string('serial')->nullable();
            $table->string('challan')->nullable();
            $table->boolean('sale_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
