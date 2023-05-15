<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sip',
        'marketing',
        'support',
        'central',
        'user_id'
    ];
}
