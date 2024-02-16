<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class CustomPage extends Model {
        protected $fillable = [
            "name",
            "route_name",
        ];

        public function navigationNode(): MorphOne
        {
            return $this->morphOne( Navigation::class, "type" );
        }
    }
?>
