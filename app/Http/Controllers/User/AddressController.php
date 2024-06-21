<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User\Address;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            function($request, $next) {
                if($request->get('address')->user_id == Auth::id()) {
                    return $next($request);
                }
                return abort(403);
            }
        )->except('store');
    }
    public function store( Request $request )
    {
        DB::beginTransaction();
        $address = Address::create([
            "user_id" => $request->user_id,
            'name' => $request->name,
            'address' => $request->address,
        ]);
        if($request->is_default) {
            Auth::user()->update(['default_address_id' => $address->id]);
        }
        DB::commit();
        // return response
        // ...
    }
    public function update( Request $request, Address $address ) {
        DB::beginTransaction();
        $address->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);
        $user = Auth::user();
        if(
            $request->is_default &&
            $user->default_address_id != $address->id
        ) {
            Auth::user()->update(['default_address_id' => $address->id]);
        }
        DB::commit();
        // return response
        // ...
    }

    public function destroy( Address $address )
    {
        $address->delete();
        // return response
        // ...
    }
}
