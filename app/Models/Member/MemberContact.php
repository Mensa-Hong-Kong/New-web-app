<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\ContactType;

class MemberContact extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "type_id",
        "link",
        "contact",
    ];
    public function type() {
        return $this->hasOne( ContactType::class );
    }
}
