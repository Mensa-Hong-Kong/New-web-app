<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class RegisteredEvent extends Model {
        protected $fillable = [
            "event_id",
            "user_id",
            "payment_method_id",
            "number_of_bring_guests",
            "answers",
            "amount",
            "expires_at",
            "is_paid",
        ];
        public function user() {
            return $this->belongsTo( User::class );
        }
        public function detail() {
            return $this->belongsTo( Event::class );
        }
    }
?>
