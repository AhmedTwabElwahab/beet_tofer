<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cashierUsers extends Model
{
    protected $fillable = [
        'branch_id',
        'user_id',
        'cashier_number',
    ];
}
