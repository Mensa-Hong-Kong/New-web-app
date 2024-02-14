<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MemberHasCertificate extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "member_id",
        "certificate_id",
        "issue_year",
        "issue_month",
        "issue_date",
    ];
}
