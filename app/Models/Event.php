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
            "content",
            "nonmember_register_open_at",
            "unsubscribed_register_open_at",
            "subscribed_register_open_at",
            "register_close_at",
            "number_of_bring_guests",
            "number_of_seats",
            "team_id",
        ];
        public function registers() {
            return $this->belongsToMany( User::class );
        }
        public function type() {
            return $this->hasOne( EventType::class );
        }
        public function payMethods() {
            return $this->hasOne( EventPaymentMethod::class );
        }
        public function prices() {
            return $this->hasMany( EventPrice::class );
        }
        public function guestPrices() {
            return $this->hasMany( EventGuestPrice::class );
        }
    }
?>
