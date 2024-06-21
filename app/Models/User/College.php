<?php

namespace App\Models\User;;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class College extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
    ];
    public function users() {
        return $this->belongsToMany( User::class, HasCollege::class );
    }
}
