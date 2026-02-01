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
        Schema::create('branch_metrics', function (Blueprint $table)
        {
            $table->id();

            $table->foreignId('branch_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('metric_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('date');
            $table->decimal('value', 14, 2);

            $table->timestamps();

            $table->unique(['branch_id', 'metric_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_metrics');
    }
};
