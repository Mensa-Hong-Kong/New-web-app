<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Mobile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_id",
        "country_code",
        "mobile",
        "is_display",
        "verified_at",
    ];
}
