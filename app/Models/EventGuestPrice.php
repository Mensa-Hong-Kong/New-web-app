<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class EventGuestPrice extends Model {
        protected $fillable = [
            'price',
            "event_id",
            "type_id",
            "spatie_product_id",
        ];
    }
?>
