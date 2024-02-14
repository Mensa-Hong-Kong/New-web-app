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
}
