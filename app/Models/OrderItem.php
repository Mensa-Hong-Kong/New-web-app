<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class OrderItem extends Model {
        protected $fillable = [
            "order_id",
            "address",
            "product_id",
            "quantity",
            "price",
            "amount",
        ];
        public function items() {
            return $this->belongsTo( OrderItem::class );
        }
        public function product() {
            return $this->belongsTo( Product::class );
        }
    }
?>
