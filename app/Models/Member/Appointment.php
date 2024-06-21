<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;
use App\Models\Member;

class Appointment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "member_id",
        "organize_id",
        "team_id",
        "role_id",
        "from_year",
        "from_mouth",
        "from_date",
        "from",
        "to_year",
        "to_mouth",
        "to_date",
        "to",
    ];
    public function member() {
        return $this->belongsTo( Member::class );
    }
    public function organize() {
        return $this->belongsTo( Organize::class );
    }
    public function team() {
        return $this->belongsTo( Team::class );
    }
    public function role() {
        return $this->belongsTo( AppointmentRole::class );
    }
}
