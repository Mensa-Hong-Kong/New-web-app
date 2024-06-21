<?php

namespace App\Models\User;;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CollegeCertificateType extends Model
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
        return $this->belongsToMany( User::class, HasCollege::class, 'user_id', 'type_id');
    }
}
