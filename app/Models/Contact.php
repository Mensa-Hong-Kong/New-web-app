<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Contact extends Pivot
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
        "order_number",
    ];
    public function type() {
        return $this->hasOne( ContactType::class );
    }
}
