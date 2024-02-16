<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class Product extends Model {
        protected $fillable = [
            "name",
            "keywords",
            "image",
            "description",
            "for_sale",
            "not_for_sale_at",
            "total",
            "quantity",
        ];
        public function cart() {
            return $this->hasMany( Cart::class );
        }
        public function prices() {
            return $this->hasMany( Price::class );
        }
    }
?>
