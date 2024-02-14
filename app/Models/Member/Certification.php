<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "member_id",
        "name",
        "issue_year",
        "issue_month",
        "issue_date",
    ];
}
