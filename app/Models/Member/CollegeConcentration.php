<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class CollegeConcentration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name"
    ];
    public function firstConcentrationMembers() {
        return $this->belongsToMany( Member::class, MemberHasCollege::class );
    }
    public function secondConcentrationMembers() {
        return $this->belongsToMany( Member::class, MemberHasCollege::class );
    }
    public function thirdConcentrationMembers() {
        return $this->belongsToMany( Member::class, MemberHasCollege::class );
    }
}
