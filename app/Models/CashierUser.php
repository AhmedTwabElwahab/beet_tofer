<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashierUser extends Model
{
    protected $table = 'cashier_users';
    protected $fillable = ['branch_id', 'user_id', 'cashier_number'];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
