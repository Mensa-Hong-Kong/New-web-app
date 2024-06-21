<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User\Mobile;

class MobileController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            function($request, $next) {
                if($request->get('mobile')->user_id == Auth::id()) {
                    return $next($request);
                }
                return abort(403);
            }
        )->except('store');
    }
    public function store( Request $request )
    {
        DB::beginTransaction();
        $mobile = Mobile::create([
            "user_id" => $request->user_id,
            "country_code" => $request->country_code,
            'mobile' => $request->mobile,
        ]);
        if($request->is_default) {
            Auth::user()->update(['default_mobile_id' => $mobile->id]);
        }
        // send verify sms/whatsapp
        // ...
        DB::commit();
        // return response
        // ...
    }
    public function update( Request $request, Mobile $mobile ) {
        DB::beginTransaction();
        $update = [
            "country_code" => $request->country_code,
            'mobile' => $request->mobile,
            'is_display' => $request->is_display,
        ];
        if($request->is_default) {
            Auth::user()->update(['default_mobile_id' => $mobile->id]);
        }
        if($request->mobile != $mobile->mobile) {
            $update['verified_at'] = '';
            // send verify sms/whatsapp
            // ...
        }
        $mobile->update($update);
        DB::commit();
        // return response
        // ...
    }

    public function destroy( Mobile $mobile )
    {
        $mobile->channels()->detach();
        $mobile->delete();
        // return response
        // ...
    }
}
