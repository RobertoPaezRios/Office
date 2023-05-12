<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Sale;

class Collaborator extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'commission',
    ];

    protected $hidden = [
        'sale_id'
    ];

    /**
     * Get the sale associated with the Collaborator
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sale(): HasOne
    {
        return $this->hasOne(Sale::class, 'id', 'sale_id');
    }
}
