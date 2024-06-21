<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class HasAward extends Model
{
    protected $table = 'user_has_awards';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_id",
        "award_id",
        "issue_year",
        "issue_month",
        "issue_date",
    ];
    public function user() {
        return $this->belongsTo( User::class );
    }
}
