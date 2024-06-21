<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Contact;
use App\Models\Member\Contact as MemberContact;

class ContactType extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
    ];
    public function contacts() {
        return $this->belongsTo( Contact::class );
    }
    public function memberContacts() {
        return $this->belongsTo( MemberContact::class );
    }
}
