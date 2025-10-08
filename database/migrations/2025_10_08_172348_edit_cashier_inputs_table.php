<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // إضافة العمود
        Schema::table('cashier_inputs', function (Blueprint $table) {
            $table->decimal('sales_return', 10, 2)->default(0)->after('network_value');
            $table->decimal('bond_number', 10, 2)->default(0)->after('network_value');
        });

        // تحديث البيانات القديمة لتكون صفر
        DB::table('cashier_inputs')->update(['sales_return' => 0]);
        DB::table('cashier_inputs')->update(['bond_number' => 0]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cashier_inputs', function (Blueprint $table) {
            $table->dropColumn('sales_return');
            $table->dropColumn('bond_number');
        });
    }
};
