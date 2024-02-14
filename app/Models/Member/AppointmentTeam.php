<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class Affiliation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
    ];
}
