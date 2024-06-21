<?php

namespace App\Models\User;;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_id",
        'name',
        'address',
    ];

    public function member() {
        return $this->belongsTo( User::class );
    }
}
