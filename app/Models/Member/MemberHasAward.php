<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class MemberHasAward extends Model
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
    public function member() {
        return $this->belongsTo( Member::class );
    }
    public function name() {
        return $this->belongsTo( School::class );
    }
}
