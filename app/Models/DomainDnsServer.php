<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomainDnsServer extends Model
{
    protected $fillable = [
        'user_id',
        'domain_name',
        'status',
    ];
}
