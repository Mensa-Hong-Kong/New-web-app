<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class Committee extends Model {
        protected $fillable = [
            "team_id",
            "description",
        ];
        public function committee() {
            return $this->belongsTo( User::class );
        }
        public function team() {
            return $this->belongsTo( Team::class );
        }
    }
?>
