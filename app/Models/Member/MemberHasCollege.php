<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class MemberHasCollege extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "member_id",
        "college_id",
        "from_year",
        "from_mouth",
        "from_date",
        "to_year",
        "to_mouth",
        "to_date",
        "concentration1_id",
        "concentration2_id",
        "concentration3_id",
        "certificate_type_id",
    ];
    public function member() {
        return $this->belongsTo( Member::class );
    }
    public function name() {
        return $this->belongsTo( College::class );
    }
    public function firstConcentration() {
        return $this->belongsTo( CollegeConcentration::class, "concentration1_id" );
    }
    public function secondConcentration() {
        return $this->belongsTo( CollegeConcentration::class, "concentration2_id" );
    }
    public function thirdConcentration() {
        return $this->belongsTo( CollegeConcentration::class, "concentration3_id" );
    }
    public function certificateType() {
        return $this->belongsTo( CollegeCertificateType::class, "certificate_type_id" );
    }
}
