<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'forwarding_email',
        "default_address_id",
        "image",
        "description",
        "public_type_id",
    ];

    public function contacts() {
        return $this->hasMany( MemberContact::class );
    }
    public function publicType() {
        return $this->belongsTo( PublicType::class );
    }
    public function profilePassword() {
        return $this->hasOne( ProfilePassword::class );
    }
    public function certifications() {
        return $this->hasMany( MemberHasCertification::class );
    }
    public function certificates() {
        return $this->hasMany( MemberHasCertificate::class );
    }
    public function memberships() {
        return $this->hasMany( MemberHasOtherMembership::class );
    }
    public function appointments() {
        return $this->hasMany( Appointment::class );
    }
    public function skills() {
        return $this->belongsToMany( Skill::class, MemberHasSkill::class );
    }
    public function works() {
        return $this->hasMany( Work::class );
    }
    public function colleges() {
        return $this->hasMany( MemberHasCollege::class );
    }
    public function schools() {
        return $this->hasMany( MemberHasSchool::class );
    }
    public function awards() {
        return $this->hasMany( MemberHasAward::class );
    }
}