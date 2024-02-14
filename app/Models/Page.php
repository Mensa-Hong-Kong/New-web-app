<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class Page extends Model {
        protected $fillable = [
            "navigation_id",
            "path",
            "title", // 中文 30 英文60
            "description",
            "keywords",
            "og_title", // for 社群網站 / 即時通訊
            "og_image",
            "og_description",
            "limit", // 0 user, 1 unsubscribed member, 2 unsubscribed member, 3 admin
            "content",
        ];
    }
?>
