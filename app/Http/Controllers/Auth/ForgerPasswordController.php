<?php
    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    class ForgerPasswordController extends Controller {
        protected $redirectTo = '/home';
        public function create() {
            // ...
        }
        public function store( Request $request ) {
            // ...
        }
        public function edit( $id, $token ) {
            // ...
        }
    }
?>
