<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\ContactType;

class Contact extends Pivot
{
    protected $table = 'member_contact';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "member_id",
        "name",
        "type_id",
        "link",
        "contact",
        "order_number",
    ];
    public function type() {
        return $this->hasOne( ContactType::class );
    }
}
