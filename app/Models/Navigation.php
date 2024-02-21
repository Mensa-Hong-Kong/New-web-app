<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasOne;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Relations\MorphTo;

    class Navigation extends Model {
        protected $table = 'navigation';
        protected $fillable = [
            "name",
            "parent_id",
            "order_number",
            "page_id",
            "page_type",
        ];

        public function page(): MorphTo
        {
            return $this->morphTo( __FUNCTION__, "type" );
        }

        public function parent(): HasOne
        {
            return $this->hasOne( Navigation::class, 'id', 'parent_id');
        }

        public function children(): HasMany
        {
            return $this->hasMany( Navigation::class, 'parent_id', 'id');
        }

        public function roles()
        {
            return $this->belongsToMany( Role::class, 'role_can_view_navigation' );
        }
    }
