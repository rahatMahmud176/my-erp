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
        Schema::create('supplier_transitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->foreignId('challan_id')->constrained('challans')->onDelete('cascade')->default(0);
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            $table->float('deposit', 10,2)->default(0);
            $table->float('due', 10,2)->default(0);
            $table->string('note')->default('-');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_transitions');
    }
};
