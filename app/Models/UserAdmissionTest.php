<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Relations\Pivot;

    class UserAdmissionTest extends Pivot {
        protected $fillable = [
            "user_id",
            "admission_test_id",
            "is_attend",
            "resulted_at",
        ];
    }
?>
