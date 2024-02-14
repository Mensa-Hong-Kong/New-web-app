<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Permission;
    use App\Models\PermissionType;
    use App\Models\RoleHasModulePermission;
    use App\Models\UserHasModulePermission;
    use App\Models\Forum;
    use App\Models\Page;
    use App\Models\User;

    class Navigation extends Model {
        protected $table = 'navigation';
        protected $fillable = [
            "name",
            "limit", // 0 user, 1 unsubscribed member, 2 unsubscribed member, 3 admin
            "parent_id",
            "order_number",
        ];
        public function page() {
            return $this->hasOne( Page::class, 'id', 'parent_id');
        }
        public function customPage() {
            return $this->hasOne( CustomPage::class, 'id', 'parent_id');
        }
        public function parent() {
            return $this->hasOne( Navigation::class, 'id', 'parent_id');
        }
        public function children() {
            return $this->hasMany( Navigation::class, 'parent_id', 'id');
        }
    }
?>
