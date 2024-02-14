<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FrequentlyAskedQuestion extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "question",
        "answer",
    ];
}
