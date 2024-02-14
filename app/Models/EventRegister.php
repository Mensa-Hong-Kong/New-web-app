<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class EventRegister extends Model {
        protected $fillable = [
            "event_id",
            "role_id",
            "number_guests",
            "answers",
            "amount",
            "expires_at",
            "is_paid",
        ];
        public function user() {
            return $this->belongsTo( User::class );
        }
        public function event() {
            return $this->belongsTo( Event::class );
        }
    }
?>
