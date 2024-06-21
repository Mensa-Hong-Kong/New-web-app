<?php

namespace App\Models\User;;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CollegeConcentration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name"
    ];
    public function firstConcentrationUsers() {
        return $this->belongsToMany( User::class, HasCollege::class );
    }
    public function secondConcentrationUsers() {
        return $this->belongsToMany( User::class, HasCollege::class );
    }
    public function thirdConcentrationUsers() {
        return $this->belongsToMany( User::class, HasCollege::class );
    }
}
