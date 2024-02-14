<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Relations\Pivot;

    class AdmissionTestOrder extends Model {
        protected $fillable = [
            "user_id",
            "spatie_product_id",
            "expires_at",
            "is_paid",
        ];
    }
?>
