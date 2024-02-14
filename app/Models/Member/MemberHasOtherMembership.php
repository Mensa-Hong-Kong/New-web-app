<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MemberHasOtherMembership extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "member_id",
        "other_membership_id",
        "type",
        "from_year",
        "from_mouth",
        "from_date",
        "to_year",
        "to_mouth",
        "to_date",
    ];
}
