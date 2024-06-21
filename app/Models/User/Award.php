<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Award extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "is_limit",
    ];
    public function users() {
        return $this->belongsToMany(User::class, HasAward::class);
    }
}
