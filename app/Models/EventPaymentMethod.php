<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class EventPaymentMethod extends Model {
        protected $fillable = [
            "name",
        ];
        public function events() {
            return $this->belongsToMany( Event::class );
        }
    }
?>
