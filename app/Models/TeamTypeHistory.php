<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Team;
use App\Models\TeamType;
use App\Models\Sale;

class TeamTypeHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'type_id'
    ];

    /**
     * Get the team associated with the TeamTypeHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function team(): HasOne
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }

    /**
     * Get the type associated with the TeamTypeHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type(): HasOne
    {
        return $this->hasOne(TeamType::class, 'id', 'type_id');
    }

    /**
     * Get all of the sales for the TeamTypeHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'team_type_history_id', 'id');
    }
}
