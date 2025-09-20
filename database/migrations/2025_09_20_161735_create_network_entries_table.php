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
        Schema::create('network_entries', function (Blueprint $table) {
            $table->id();
            $table->string('account_number');       // رقم الحساب
            $table->string('analytical_account')->nullable(); // الحساب التحليلي
            $table->string('description')->nullable(); // البيان
            $table->decimal('debit_local', 15, 2)->default(0); // مدين محلي
            $table->decimal('credit_local', 15, 2)->default(0); // دائن محلي
            $table->string('currency')->default('SAR'); // العملة
            $table->string('cost_center')->nullable();  // مركز التكلفة
            $table->date('due_date')->nullable();       // تاريخ الاستحقاق
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('network_entries');
    }
};
