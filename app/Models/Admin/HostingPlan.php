<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class HostingPlan extends Model
{
     protected $fillable = [
        'name',
        'storage_gb',
        'price',
        'renewal_price',
        'stripe_price',
        'stripe_price_renewal',
        'is_active',
    ];

    protected $casts = [
        'storage_gb' => 'integer',
        'price' => 'decimal:2',
        'renewal_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

}
