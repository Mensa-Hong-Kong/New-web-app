<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class SchoolGrade extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
    ];
}
