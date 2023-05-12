<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Buyer;
use App\Models\Seller;
use App\Models\Collaborator;
use App\Models\Detail;
use App\Models\Team;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'amount',
        'commission'
    ];

    protected $hidden = [
        'seller_id',
        'lister_id',
        'team_id'
    ];

    /**
     * Get all of the buyers for the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buyers(): HasMany
    {
        return $this->hasMany(Buyer::class, 'sale_id', 'id');
    }

    /**
     * Get all of the collaborators for the Sale
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function collaborators(): HasMany {
        return $this->hasMany(Collaborator::class, 'sale_id', 'id');
    }

    /**
     * Get all of the sellers for the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sellers(): HasMany
    {
        return $this->hasMany(Seller::class, 'sale_id', 'id');
    }

    /**
     * Get the detail associated with the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detail(): HasOne
    {
        return $this->hasOne(Detail::class, 'sale_id', 'id');
    }

    /**
     * Get the lister associated with the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lister(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'lister_id');
    }

    /**
     * Get the seller associated with the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function seller(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'seller_id');
    }

    /**
     * Get the team associated with the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function team(): HasOne
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }
}
