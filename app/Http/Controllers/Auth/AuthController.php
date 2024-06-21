<?php
    namespace App\Http\Controllers\Auth;

    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;

    class AuthController extends Controller {
        protected $redirectTo = '/home';
        public function index() {
            // ...
        }
        public function login( Request $request ) {
            // ...
        }
        public function register( $id, $token ) {
            // ...
        }
        public function reset( Request $request, $id ) {
            // ...
        }
        public function logout() {
            auth('web')->logout();
            return redirect()->route('login');
        }
    }
?>
