<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class SpecialInterestsGroup extends Model {
        protected $fillable = [
            "team_id",
            "description",
        ];
        public function team() {
            return $this->belongsTo( Team::class );
        }
    }
?>
