<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class College extends Model
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