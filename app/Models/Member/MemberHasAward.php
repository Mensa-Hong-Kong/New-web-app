<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MemberHasAward extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "member_id",
        "award_id",
        "issue_year",
        "issue_month",
        "issue_date",
    ];
}
