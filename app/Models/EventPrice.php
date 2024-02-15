<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class EventPrice extends Model {
        protected $fillable = [
            'price',
            "type_id",
            "spatie_product_id",
        ];
        public function type() {
            return $this->belongsTo( EventType::class, "type_id" );
        }
    }
?>
