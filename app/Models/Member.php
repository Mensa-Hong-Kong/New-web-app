<?php

namespace App\Models;
use App\Models\Member\Contact;
use App\Models\Member\PublicType;
use App\Models\Member\ProfilePassword;
use App\Models\Member\HasCertification;
use App\Models\Member\HasCertificate;
use App\Models\Member\HasOtherMembership;
use App\Models\Member\Appointment;
use App\Models\Member\Skill;


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
        "image",
        "description",
        "public_type_id",
    ];

    public function contacts() {
        return $this->hasMany( Contact::class );
    }
    public function publicType() {
        return $this->belongsTo( PublicType::class );
    }
    public function profilePassword() {
        return $this->hasOne( ProfilePassword::class );
    }
    public function certifications() {
        return $this->hasMany( HasCertification::class );
    }
    public function certificates() {
        return $this->hasMany( HasCertificate::class );
    }
    public function otherMemberships() {
        return $this->hasMany( HasOtherMembership::class );
    }
    public function appointments() {
        return $this->hasMany( Appointment::class );
    }
    public function skills() {
        return $this->belongsToMany( Skill::class );
    }
}
