<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Sale;

class Buyer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'nif',
        'address',
        'town',
        'phone'
    ];

    protected $hidden = [
        'sale_id'
    ];

    /**
     * Get the sale associated with the Buyer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sale(): HasOne
    {
        return $this->hasOne(Sale::class, 'id', 'sale_id');
    }
}
