<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class NotificationChannel extends Model {
        protected $fillable = [
            "name",
        ];
        public function users() {
            return $this->belongsToMany( User::class );
        }
    }
?>
