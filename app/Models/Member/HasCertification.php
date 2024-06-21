<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Relations\Pivot;

class HasCertification extends Pivot
{
    protected $table = 'member_has_certifications';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "member_id",
        "certification_id",
        "issue_year",
        "issue_month",
        "issue_date",
    ];
    public function member() {
        return $this->belongsTo( Certification::class );
    }
    public function name() {
        return $this->belongsTo( Certification::class );
    }
}
