<?php

namespace App\Models\User;;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_id",
        "email",
        "is_display",
        "verified_at",
    ];
}
