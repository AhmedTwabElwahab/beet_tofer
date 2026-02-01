<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class metrics extends Model
{
    protected $fillable = [
        'key',
        'name',
        'category'
    ];

    public function branchMetrics()
    {
        return $this->hasMany(branch_metrics::class);
    }
}
