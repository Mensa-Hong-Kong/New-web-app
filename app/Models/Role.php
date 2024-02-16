<?php
    namespace App\Models;

    use Spatie\Permission\Models\Role as Model;
    use App\Models\RoleType;

    class Role extends Model {
        protected $fillable = [
            "role_id",
            "team_id",
            "name",
            "guard_name",
            "appointment_role_id",
            "order_name",
        ];

        public function type() {
            /* Relating class, Foreign key( option ), owner key( option ) */
            return $this->belongsTo( RoleType::class, "type_id", "id" );
        }

        public function pages(): MorphToMany
        {
            return $this->morphedByMany( Page::class, 'page_type', "role_can_view_pages" );
        }

        public function customPages(): MorphToMany
        {
            return $this->morphedByMany(Video::class, 'page_type', "role_can_view_pages" );
        }
    }
?>
