<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{

    public const STATUSES = [
        'active' => 'Активен',
        'expired' => 'Изтекъл',
        'pending' => 'В процес',
        'neutral' => 'Очаква информация',
    ];

    protected $fillable = [
        'user_id',
        'domain_name',
        'price',
        'is_domain_locked',
        'period_in_years',
        'registered_at',
        'expires_at',
    ];

    protected $casts = [
        'registered_at' => 'datetime',
        'expires_at' => 'datetime',
        'price' => 'decimal:2',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
