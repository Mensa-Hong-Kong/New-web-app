<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\MorphToMany;
    use App\Models\User;

    class EmailChannel extends Model {
        protected $fillable = [
            "name",
            "team_id",
        ];
        public function users(): MorphToMany
        {
            return $this->morphToMany( User::class, "user_subscription_channels" );
        }
    }

