<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;
use App\Models\Member;
use App\Models\Team as MemsaTeam;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
    ];
    public function appointments() {
        return $this->hasMany( Appointment::class );
    }
    public function members() {
        return $this->belongsToMany( Member::class, HasOtherMembership::class );
    }
    public function systemTeam() {
        return $this->hasOne( MemsaTeam::class );
    }
}
