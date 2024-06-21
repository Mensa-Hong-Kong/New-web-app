<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Member\Certification;
use App\Models\Member\HasCertification;

class CertificationController extends Controller
{
    private $memberID;
    private $certification;
    public function __construct()
    {
        $this->middleware(
            function($request, $next) {
                $this->certification = HasCertification::with([
                        'certification' => function($query) {
                            $query->withCount('members');
                        },
                    ])->findOrFail($request->get('certification'));
                if($this->certification['member_id'] == Auth::user()->member()->id) {
                    return $next($request);
                }
                return abort(403);
            }
        )->except('store');
    }
    public function store( Request $request ) {
        DB::beginTransaction();
        $certification = Certification::findOrCreate(['name' => $request->name]);
        HasCertification::create([
            "member_id" => Auth::user()->member()->id,
            "certification_id" => $certification->id,
            "issue_year" => $request->issue_year,
            "issue_month" => $request->issue_month,
            "issue_date" => $request->issue_date,
        ]);
        DB::commit();
        // return response
        // ...
    }

    public function update( Request $request, $id ) {
        $certification = $this->certification->certification;
        DB::beginTransaction();
        if(
            $certification->members_count == 1 &&
            $certification->name != $request->name
        ) {
            $existCertification = Certification::firstWhere('name', $request->name);
            if(is_null($existCertification)) {
                $certification->update(['name' => $request->name]);
            } else {
                $certification->delete();
                $certification = $existCertification;
            }
        }
        $this->certification->update([
            "certification_id" => $certification->id,
            "issue_year" => $request->issue_year,
            "issue_month" => $request->issue_month,
            "issue_date" => $request->issue_date,
        ]);
        DB::commit();
        // return response
        // ...
    }

    public function destroy( $id ) {
        DB::beginTransaction();
        $certification = $this->certification->certification;
        if($certification->members_count == 1) {
            $certification->delete();
        }
        $this->certification->delete();
        DB::commit();
        // return response
        // ...
    }
}
