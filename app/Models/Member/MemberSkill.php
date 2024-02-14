<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MemberSkill extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "member_id",
        "skill_id",
    ];
}
