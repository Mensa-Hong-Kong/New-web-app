<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MemberHasSubscription extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "member_id",
        "subscription_id",
        "price",
    ];
}
