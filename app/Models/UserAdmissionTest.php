<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Relations\Pivot;

    class UserAdmissionTest extends Model {
        protected $fillable = [
            "admission_test_id",
            "is_attend",
            "resulted_at",
        ];
    }
?>
