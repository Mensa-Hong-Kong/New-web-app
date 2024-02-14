<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OtherMembership extends Pivot
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
