<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class Event extends Model {
        protected $fillable = [
            "title", // 中文 30 英文60
            "image",
            "description",
            "keywords",
            "og_title", // for 社群網站 / 即時通訊
            "og_image",
            "og_description",
            "limit", // 0 user, 1 unsubscribed member, 2 unsubscribed member, 3 admin
            "content",
            "need_paid_for_register",
            "subscribed_register_open_at",
            "unsubscribed_register_open_at",
            "nonmember_register_open_at",
            "register_close_at",
            "bring_guests_limit",
            "number_of_seats",
            "event_type_id",
            "questions",
        ];
        public function registers() {
            return $this->hasMany( RegisteredEvent::class );
        }
        public function type() {
            return $this->hasOne( EventType::class );
        }
        public function prices() {
            return $this->hasMany( EventPrice::class );
        }
        public function paymentMethods() {
            return $this->belongsToMany( EventPaymentMethod::class, "event_has_payment_method", "method_id" );
        }
    }
?>
