<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

use App\Models\TeamTypeHistory;

class TeamType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sip',
        'marketing',
        'support',
        'central',
        'user_id',
        'group_id'
    ];

    /**
     * Get all of the historics for the TeamType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function historics(): HasMany
    {
        return $this->hasMany(TeamTypeHistory::class, 'type_id', 'id');
    }
}
