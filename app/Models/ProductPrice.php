<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class ProductPrice extends Model {
        protected $fillable = [
            "price",
            "type_id",
            "spatie_product_id",
            "for_sale_at",
        ];
        public function product() {
            return $this->belongsTo( Product::class );
        }
        public function type() {
            return $this->belongsTo( ProductPriceType::class, "type_id" );
        }
    }
?>
