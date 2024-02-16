<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class ProductPriceType extends Model {
        protected $fillable = [
            "name",
        ];
        public function product() {
            return $this->belongsToMany( Product::class, ProductPrice::class, "product_id", "type_id" );
        }
    }
?>
