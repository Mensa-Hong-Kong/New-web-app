<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Member\Team as AppointmentTeam;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "appointment_team_id"
    ];
    public function roles() {
        return $this->hasMany(Role::class);
    }
    public function users() {
        return $this->belongsToMany(User::class);
    }
    public function Appointment() {
        return $this->belongsTo(AppointmentTeam::class);
    }
    public function committee() {
        return $this->hasOne(Committee::class);
    }
}
