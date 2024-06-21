<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class HasSchool extends Model
{
    protected $table = 'user_has_schools';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_id",
        "school_id",
        "from_year",
        "from_mouth",
        "from_date",
        "to_year",
        "to_mouth",
        "to_date",
        "from_grade_id",
        "to_grade_id",
    ];
    public function users() {
        return $this->belongsTo( User::class );
    }
    public function name() {
        return $this->belongsTo( School::class );
    }
    public function fromGrade() {
        return $this->belongsTo( SchoolGrade::class, );
    }
    public function toGrade() {
        return $this->belongsTo( SchoolGrade::class );
    }
}
