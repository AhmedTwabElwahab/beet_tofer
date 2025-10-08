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
        Schema::create('cashier_audits', function (Blueprint $table)
        {
            $table->id();
            $table->date('date');
            $table->foreignId('branch_id');
            $table->decimal('balance', 15, 2)->default(0);
            $table->unsignedBigInteger('user_id');
            $table->string('cashier_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashier_audits');
    }
};
