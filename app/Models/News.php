<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class News extends Model {
        protected $fillable = [
            "title", // 中文 30 英文60
            "description",
            "keywords",
            "og_title", // for 社群網站 / 即時通訊
            "og_image",
            "og_description",
            "content",
        ];
    }

