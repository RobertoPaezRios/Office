<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\OwnerGroup;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'group_id'
    ];

    /**
     * Get the owner_group associated with the Owner
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function owner_group(): HasOne
    {
        return $this->hasOne(OwnerGroup::class, 'id', 'group_id');
    }

    /**
     * Get the user associated with the Owner
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
