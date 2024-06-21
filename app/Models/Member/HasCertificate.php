<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Member;

class HasCertificate extends Pivot
{
    protected $table = 'member_has_certificates';
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
