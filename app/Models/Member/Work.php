<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberHasWork extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "member_id",
        "company_id",
        "position_id",
        "from_year",
        "from_mouth",
        "from_date",
        "to_year",
        "to_mouth",
        "to_date",
    ];
}