<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class Organize extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "is_limit",
    ];
    public function appointments() {
        return $this->hasMany( Appointment::class );
    }
    public function members() {
        return $this->belongsToMany( Member::class, MemberHasOtherMembership::class );
    }
}
