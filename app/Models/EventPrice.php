<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class EventPrice extends Model {
        protected $fillable = [
            'price',
            "type_id",
            "spatie_product_id",
            "for_register_at",
        ];
        public function type() {
            return $this->belongsTo( PriceType::class, "type_id" );
        }
    }
?>
