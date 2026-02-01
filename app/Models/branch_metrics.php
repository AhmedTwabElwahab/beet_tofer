<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class branch_metrics extends Model
{
    protected $fillable = [
        'branch_id',
        'metric_id',
        'date',
        'value'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function metric()
    {
        return $this->belongsTo(metrics::class);
    }
}
