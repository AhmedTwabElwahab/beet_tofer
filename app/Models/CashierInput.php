<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashierInput extends Model
{
    protected $fillable = [
        'cashier_number',
        'branch_id',
        'cash_value',
        'network_value',
        'input_date',
    ];

    protected $casts = [
        'cash_value' => 'decimal:2',
        'network_value' => 'decimal:2',
        'input_date' => 'date',
    ];

    /**
     * Get the branch that owns the cashier input.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
