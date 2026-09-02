<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{

    protected $fillable = [
        'user_id',
        'domain_name',
        'price',
        'registered_at',
        'expires_at',
        'auto_renew',
    ];

    protected $casts = [
        'registered_at' => 'datetime',
        'expires_at' => 'datetime',
        'auto_renew' => 'boolean',
        'price' => 'decimal:2',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
