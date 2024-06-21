<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\MorphOne;
    use App\Models\Navigation;

    class Page extends Model {
        protected $fillable = [
            "url",
            "title", // 中文 30 英文60
            "description",
            "keywords",
            "og_title", // for 社群網站 / 即時通訊
            "og_image",
            "og_description",
            "content",
        ];

        public function navigationNode(): MorphOne
        {
            return $this->morphOne( Navigation::class, "type" );
        }
    }

