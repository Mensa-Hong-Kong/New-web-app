<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;
use App\Models\Member\HasCertificate;
use App\Models\Member;

class Certificate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
    ];
    public function members() {
        return $this->belongsToMany( Member::class, HasCertificate::class);
    }
}
