<?php

namespace App\Models;

use App\Models\Admin\HostingPlan;
use App\Models\Admin\VPS;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserHosting extends Model
{
    protected $table = 'user_hosting';

    protected $fillable = [
        'user_id',
        'hosting_plan_id',
        'vps_id',
        'storage_gb',
        'starts_at',
        'expires_at',
        'is_active',
    ];

    protected $casts = [
        'storage_gb' => 'integer',
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user who owns this hosting account.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the hosting plan purchased for this account.
     */
    public function hostingPlan(): BelongsTo
    {
        return $this->belongsTo(HostingPlan::class, 'hosting_plan_id');
    }

    /**
     * Get the VPS assigned to this hosting account.
     */
    public function vps(): BelongsTo
    {
        return $this->belongsTo(VPS::class, 'vps_id');
    }
}
