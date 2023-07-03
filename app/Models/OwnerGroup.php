<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\User;

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
}
