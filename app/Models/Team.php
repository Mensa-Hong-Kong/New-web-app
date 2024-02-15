<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
    ];
    public function roles() {
        return $this->hasMany(Role::class);
    }
    public function users() {
        return $this->belongsToMany(User::class);
    }
}
