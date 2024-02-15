<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "member_id",
        'address',
    ];

    public function member() {
        return $this->belongsTo( Member::class );
    }
}
