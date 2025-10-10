<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CashierInput extends Model
{
    protected $fillable = [
        'cashier_number',
        'branch_id',
        'cash_value',
        'network_value',
        'sales_return',
        'input_date',
        'bond_number',
    ];

    protected $casts = [
        'cash_value'        => 'decimal:2',
        'network_value'     => 'decimal:2',
        'input_date'        => 'date',
    ];

    /**
     * Get the branch that owns the cashier input.
     */
    public function branch(): HasOne
    {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }
}
