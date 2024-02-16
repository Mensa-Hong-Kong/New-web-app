<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Relations\Pivot;

    class AdmissionTestOrder extends Model {
        protected $fillable = [
            "user_id",
            "payment_method_id",
            "price",
            "expires_at",
            "is_paid",
        ];
    }
?>
