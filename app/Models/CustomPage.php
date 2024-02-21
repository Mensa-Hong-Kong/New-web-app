<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class CustomPage extends Model {
        protected $fillable = [
            "name",
            "url",
            "is_fixed"
        ];

        public function navigationNode(): MorphOne
        {
            return $this->morphOne( Navigation::class, "type" );
        }
    }
?>
