<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User\Email;

class EmailController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            function($request, $next) {
                if($request->get('email')->user_id == Auth::id()) {
                    return $next($request);
                }
                return abort(403);
            }
        )->except('store');
    }
    public function store( Request $request )
    {
        DB::beginTransaction();
        $email = Email::create([
            "user_id" => $request->user_id,
            'email' => $request->email,
        ]);
        if($request->is_default) {
            Auth::user()->update(['default_mobile_id' => $email->id]);
        }
        // send verify email
        // ...
        DB::commit();
        // return response
        // ...
    }
    public function update( Request $request, Email $email ) {
        DB::beginTransaction();
        $update = [
            'email' => $request->email,
            'is_display' => $request->is_display,
        ];
        if($request->is_default) {
            Auth::user()->update(['default_mobile_id' => $email->id]);
        }
        if($request->email != $email->email) {
            $update['verified_at'] = '';
            // send verify email
            // ...
        }
        $email->update($update);
        DB::commit();
        // return response
        // ...
    }

    public function destroy( Email $email )
    {
        $email->channels()->detach();
        $email->delete();
        // return response
        // ...
    }
}
