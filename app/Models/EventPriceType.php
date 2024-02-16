<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class PriceType extends Model {
        protected $fillable = [
            "name",
        ];
        public function events() {
            return $this->belongsToMany( Event::class, EventPrice::class, "event_id", "type_id" );
        }
    }
?>
