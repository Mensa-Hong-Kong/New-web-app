<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class MemberHasOtherMembership extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "member_id",
        "association_id",
        "type_id",
        "from_year",
        "from_mouth",
        "from_date",
        "to_year",
        "to_mouth",
        "to_date",
    ];
    public function member() {
        return $this->belongsTo( Member::class );
    }
    public function association() {
        return $this->belongsTo( Association::class );
    }
    public function type() {
        return $this->belongsTo( OtherMembershipType::class );
    }
}