<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Contact extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "type",
        "link",
        "contact",
    ];
}
