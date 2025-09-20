<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class networkEntry extends Model
{
    protected $fillable = [
        'account_number',
        'analytical_account',
        'description',
        'debit_local',
        'credit_local',
        'currency',
        'cost_center',
        'due_date',
    ];
}
