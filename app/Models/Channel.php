<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class Channel extends Model {
        protected $fillable = [
            "name",
            "team_id",
        ];
        public function users() {
            return $this->belongsToMany( User::class, "user_subscription_channels" );
        }
    }
?>
