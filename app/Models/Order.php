<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class Order extends Model {
        protected $fillable = [
            "user_id",
            "role_id",
            "address",
            "amount",
            "expires_at",
            "payment_method_id",
            "is_paid",
            "is_sent_logistics",
        ];
        public function user() {
            return $this->belongsTo( User::class );
        }
        public function items() {
            return $this->hasMany( OrderItem::class );
        }
    }
?>
