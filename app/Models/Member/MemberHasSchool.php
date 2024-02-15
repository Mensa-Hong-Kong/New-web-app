<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class MemberHasSchool extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "member_id",
        "school_id",
        "from_year",
        "from_mouth",
        "from_date",
        "to_year",
        "to_mouth",
        "to_date",
        "from_grade",
        "to_grade",
    ];
    public function member() {
        return $this->belongsTo( Member::class );
    }
    public function name() {
        return $this->belongsTo( School::class );
    }
}
