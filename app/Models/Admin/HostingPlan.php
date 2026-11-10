<?php

namespace App\Models\Admin;

use App\Models\UserHosting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HostingPlan extends Model
{
    protected $fillable = [
        'name',
        'storage_gb',
        'price',
        'renewal_price',
        'stripe_price',
        'stripe_price_renewal',
        'constant_package_name',
        'is_active',
    ];

    protected $casts = [
        'storage_gb' => 'integer',
        'price' => 'decimal:2',
        'renewal_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get all hosting accounts purchased with this plan.
     */
    public function hostingAccounts(): HasMany
    {
        return $this->hasMany(UserHosting::class, 'hosting_plan_id');
    }

    
}
