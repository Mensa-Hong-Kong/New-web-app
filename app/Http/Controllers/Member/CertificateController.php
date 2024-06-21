<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Member\Certificate;
use App\Models\Member\HasCertificate;

class CertificateController extends Controller
{
    private $certificate;
    public function __construct()
    {
        $this->middleware(
            function($request, $next) {
                $this->certificate = HasCertificate::with([
                    'certificate' => function($query) {
                        $query->withCount('members');
                    }
                ])->findOrFail($request->get('certificate'));
                if($this->certificate['member_id'] == Auth::user()->member()->id) {
                    return $next($request);
                }
                return abort(403);
            }
        )->except('store');
    }
    public function store( Request $request ) {
        DB::beginTransaction();
        $certificate = Certificate::findOrCreate(['name' => $request->name]);
        HasCertificate::create([
            "member_id" => Auth::user()->member()->id,
            "certificate_id" => $certificate->id,
            "issue_year" => $request->issue_year,
            "issue_month" => $request->issue_month,
            "issue_date" => $request->issue_date,
        ]);
        DB::commit();
        // return response
        // ...
    }

    public function update( Request $request, $id ) {
        $certificate = $this->certificate->certificate;
        DB::beginTransaction();
        if(
            $certificate->members_count == 1 &&
            $certificate->name != $request->name
        ) {
            $existCertificate = Certificate::firstWhere('name', $request->name);
            if(is_null($existCertificate)) {
                $certificate->update(['name' => $request->name]);
            } else {
                $certificate->delete();
                $certificate = $existCertificate;
            }
        }
        $this->certificate->update([
            "certificate_id" => $certificate->id,
            "issue_year" => $request->issue_year,
            "issue_month" => $request->issue_month,
            "issue_date" => $request->issue_date,
        ]);
        DB::commit();
        // return response
        // ...
    }

    public function destroy( $id ) {
        $certificate = $this->certificate->certificate;
        DB::beginTransaction();
        if($certificate->members_count == 1) {
            $certificate->delete();
        }
        $this->certificate->delete();
        DB::commit();
        // return response
        // ...
    }
}
