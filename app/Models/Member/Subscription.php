<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "year",
        'adult_price',
        'price',
        "spatie_product_id",
    ];
}
