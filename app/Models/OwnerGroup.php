<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\User;
use App\Models\Team;
use App\Models\Owner;

class OwnerGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'color'
    ];

    /**
     * Get the owner associated with the OwnerGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function owner(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get all of the partners for the OwnerGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function partners(): HasMany
    {
        return $this->hasMany(Owner::class, 'group_id', 'id');
    }

    /**
     * Get all of the teams for the OwnerGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teams(): HasMany
    {
        return $this->hasMany(Team::class, 'group_id', 'id');
    }
}
