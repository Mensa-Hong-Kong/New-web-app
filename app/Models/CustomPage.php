<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\MorphOne;
    use App\Models\Navigation;

    class CustomPage extends Model {
        protected $fillable = [
            "name",
            "url",
        ];

        public function navigationNode(): MorphOne
        {
            return $this->morphOne( Navigation::class, "type" );
        }
    }

