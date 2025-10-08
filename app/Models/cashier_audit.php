<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cashier_audit extends Model
{
    protected $fillable = [
        'date',
        'branch_id',
        'balance',
        'user_id',
        'cashier_number',
    ];
}
