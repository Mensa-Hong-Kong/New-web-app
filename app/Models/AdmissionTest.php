<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Navigation;

    class AdmissionTest extends Model {
        protected $fillable = [
            "date",
            "time",
            "number_of_seats",
        ];
        public function users() {
            return $this->belongsToMany(User::class, UserAdmissionTest);
        }
    }
?>
