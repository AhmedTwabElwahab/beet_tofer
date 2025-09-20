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
        Schema::create('cashier_inputs', function (Blueprint $table) {
            $table->id();
            $table->string('cashier_number');
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            $table->decimal('cash_value', 10, 2);
            $table->decimal('network_value', 10, 2);
            $table->date('input_date')->default(now()->format('Y-m-d'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashier_inputs');
    }
};
