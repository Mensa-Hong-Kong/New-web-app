<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
    ];
    public function members() {
        return $this->belongsToMany( Member::class, MemberHasSchool::class );
    }
}
