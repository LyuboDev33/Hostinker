<?php

namespace App\Models\Admin;

use App\Models\UserHosting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VPS extends Model
{
    protected $table = 'vps';

    protected $fillable = [
        'host',
        'port',
        'username',
        'password',
        'capacity_gb',
        'is_vps_full',
    ];

    protected $casts = [
        'port' => 'integer',
        'password' => 'encrypted',
        'capacity_gb' => 'integer',
        'is_vps_full' => 'boolean',
    ];

    public function hostingAccounts(): HasMany
    {
        return $this->hasMany(UserHosting::class, 'vps_id');
    }
}
