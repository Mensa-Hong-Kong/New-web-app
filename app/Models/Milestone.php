<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class Milestone extends Model {
        protected $fillable = [
            "year",
            "month",
            "name",
            "description",
        ];
    }
?>
