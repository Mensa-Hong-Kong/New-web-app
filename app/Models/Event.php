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
            "need_to_paid",
            "use_payment_gateway",
            "spatie_product_id",
            "nonmember_price",
            "unsubscribed_price",
            "subscribed_price",
            "nonmember_guests_price",
            "unsubscribed_guests_price",
            "subscribed_guests_price",
            "nonmember_register_open_at",
            "unsubscribed_register_open_at",
            "subscribed_register_open_at",
            "register_close_at",
            "bring_guests_limit",
            "number_of_bring_guests",
            "number_of_seats",
            "event_type_id",
            "questions",
        ];
        public function registers() {
            return $this->belongsToMany( User::class );
        }
        public function type() {
            return $this->hasOne( EventType::class );
        }
    }
?>
