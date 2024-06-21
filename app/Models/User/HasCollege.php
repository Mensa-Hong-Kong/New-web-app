<?php

namespace App\Models\User;;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\User;

class HasCollege extends Pivot
{
    protected $table = 'user_has_colleges';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_id",
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
        "type_id",
    ];
    public function user() {
        return $this->belongsTo( User::class );
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
        return $this->belongsTo( CollegeCertificateType::class, "type_id" );
    }
}
