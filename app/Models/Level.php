<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Team;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'user_id',
        'team_id',
    ];

    /**
     * Get the user associated with the Level
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get the team associated with the Level
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function team(): HasOne
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }
}
