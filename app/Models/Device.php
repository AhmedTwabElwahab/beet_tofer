<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Device extends Model
{
    protected $fillable = [
        'branch_id',
        'device_number',
    ];

    /**
     * Get the branch that owns the device.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the transactions for the device.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
