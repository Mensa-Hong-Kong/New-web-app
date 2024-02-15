<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class MemberHasCertificate extends Model
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
    public function member() {
        return $this->belongsTo( Member::class );
    }
    public function name() {
        return $this->belongsTo( Certificate::class );
    }
}
