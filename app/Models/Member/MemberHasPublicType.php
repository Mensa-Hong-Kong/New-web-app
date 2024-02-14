<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class MemberHasPublicType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "member_id",
        "public_type_id",
        "password",
    ];

    public function member() {
        return $this->hasOne( Member::class );
    }
    public function publicType() {
        return $this->belongsToMany( publicType::class, MemberHasPublicType::class,  );
    }
    public function certifications() {
        return $this->belongsToMany( Certification::class, MemberHasCertification::class,  );
    }
    public function certificate() {
        return $this->belongsToMany( Certificate::class, MemberHasCertificate::class );
    }
    public function memberships() {
        return $this->belongsToMany( Membership::class, MemberHasMembership::class );
    }
    public function appointments() {
        return $this->hasMany( Appointment::class );
    }
    public function skills() {
        return $this->hasMany( Skill::class, MemberHasSkill::class );
    }
    public function works() {
        return $this->hasMany( Work::class, MemberHasWork::class );
    }
    public function colleges() {
        return $this->hasMany( College::class, MemberHasCollege::class );
    }
    public function schools() {
        return $this->hasMany( School::class, MemberHasSchool::class );
    }
    public function awards() {
        return $this->hasMany( Award::class, MemberHasAward::class );
    }
}
