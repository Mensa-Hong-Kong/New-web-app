<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class Product extends Model {
        protected $fillable = [
            "name",
            "description",
            "image",
            "on_sale",
            "price",
            "unsubscribed_price",
            "subscribed_price",
            "total",
            "quantity",
            "logistics",
            "spatie_product_id",
        ];
        public function cart() {
            return $this->hasMany( Cart::class );
        }
    }
?>
