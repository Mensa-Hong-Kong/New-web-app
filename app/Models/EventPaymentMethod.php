<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class EventPaymentMethod extends Model {
        protected $fillable = [
            "name",
        ];
        public function events() {
            return $this->belongsToMany( Event::class, "event_has_payment_method", "event_id", "method_id" );
        }
    }
?>
