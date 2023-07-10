<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

use App\Models\OwnerGroup;

class GroupInvitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'group_id'
    ];

    /**
     * Get the group associated with the GroupInvitation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function group(): HasOne
    {
        return $this->hasOne(OwnerGroup::class, 'id', 'group_id');
    }
}
