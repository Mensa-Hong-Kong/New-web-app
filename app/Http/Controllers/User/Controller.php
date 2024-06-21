<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller as BaseController;
use App\Models\User;
use App\Models\User\Gender;
use App\Models\Member\PublicType;

class Controller extends BaseController
{
    public function index() {
        $user = User::with([
            "gender", "emails", "mobiles", "addresses",
            "testingFee", "tests", "awards", "schools",
            "member" => function($query) {
                $query->with([
                    "contacts", "publicType", "profilePassword",
                    "certifications", "certificates", "otherMemberships",
                    "appointments", "skills",
                ]);
            },
        ])->findOrFail(Auth::id());
        // return response
        // ...
    }

    public function edit() {
        $genders = Gender::all();
        $types = PublicType::all();
        $user = User::with([
            "emails", "mobiles", "addresses",
            "testingFee", "tests", "awards", "schools",
            "member"
        ])->findOrFail(Auth::id());
        // return response
        // ...
    }

    public function update(Request $request) {
        $update = [
            'username' => $request->username,
            'passport' => $request->passport,
            'password' => $request->password,
            'nickname' => $request->nickname,
            'given_name' => $request->given_name,
            'middle_name' => $request->middle_name,
            'family_name' => $request->family_name,
            'date_of_birth' => $request->date_of_birth,
            'gender_id' => $request->gender_id,
            'default_email_id' => $request->default_email_id,
            'default_mobile_id' => $request->default_mobile_id,
            'default_address_id' => $request->default_address_id,
        ];
        User::where('id', Auth::id())
            ->update($update);
        if(! is_null(Auth::user()->member()->get())) {
            Member::where('user_id', Auth::id())
                ->update(['public_type_id' => $request->public_type_id]);
        }
        // return response
        // ...
    }
}
