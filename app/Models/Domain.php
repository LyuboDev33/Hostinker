<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{

    protected $fillable = [
        'domain_name',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
