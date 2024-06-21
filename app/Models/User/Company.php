<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
    ];
    public function works() {
        return $this->hasMany( Work::class );
    }
}
