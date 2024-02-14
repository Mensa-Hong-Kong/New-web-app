<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class CustomPage extends Model {
        protected $fillable = [
            "navigation_id",
            "name",
            "path", // 中文 30 英文60
        ];
    }
?>
