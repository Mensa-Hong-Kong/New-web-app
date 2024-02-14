<?php
    namespace App\Models;

    use Spatie\Permission\Models\Role as Model;
    use App\Models\RoleType;

    class Role extends Model {
        protected $fillable = [
            "role_id",
            "name",
            "guard_name",
            "appointment_role_id"
        ];
        public function type() {
            /* Relating class, Foreign key( option ), owner key( option ) */
            return $this->belongsTo( RoleType::class, "type_id", "id" );
        }
    }
?>
