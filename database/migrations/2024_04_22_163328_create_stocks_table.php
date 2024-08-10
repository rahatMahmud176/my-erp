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
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->foreignId('color_id')->constrained('colors')->onDelete('cascade');
            $table->foreignId('size_id')->constrained('sizes')->onDelete('cascade');
            $table->foreignId('country_id')->constrained('country_variants')->onDelete('cascade');
            $table->foreignId('challan_id')->constrained('challans')->onDelete('cascade');
            $table->integer('unit_qty')->default(1);
            $table->integer('sub_unit_qty')->default(0);
            $table->float('purchase_price', 10,2)->nullable();
            $table->float('wholesale_price', 10,2)->nullable();
            // $table->float('price', 10,2)->nullable();
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            $table->string('serial')->nullable(); 
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
