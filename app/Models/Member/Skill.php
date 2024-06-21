<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;
use App\Models\Member;

class Skill extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "type_id",
    ];
    public function type() {
        return $this->belongsTo( SkillType::class );
    }
    public function members() {
        return $this->belongsToMany( Member::class );
    }
}
