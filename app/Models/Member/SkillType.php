<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class SkillType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
    ];
    public function skills() {
        return $this->hasMany( Skill::class );
    }
}
