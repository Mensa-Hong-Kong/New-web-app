<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User\Company;
use App\Models\User\Position;
use App\Models\User\Work;

class WorkController extends Controller
{
    private $work;
    public function __construct()
    {
        $this->middleware(
            function($request, $next) {
                $this->work = Work::with([
                    'company' => function($query) {
                        $query->withCount('users');
                    },
                    'position' => function($query) {
                        $query->withCount('users');
                    },
                ])->findOrFail($request->get('work'));
                if($this->work['user_id'] != Auth::id()) {
                    return abort(403);
                }
                return $next($request);
            }
        )->except('store');
    }

    public function store( Request $request ) {
        DB::beginTransaction();
        $company = Company::findOrCreate(['name' => $request->company]);
        $position = Position::findOrCreate(['name' => $request->position]);
        Work::create([
            "user_id" => Auth::id(),
            "company_id" => $company->id,
            "position_id" => $position->id,
            "from_year" => $request->from_year,
            "from_month" => $request->from_month,
            "from_date" => $request->from_date,
            "to_year" => $request->to_year,
            "to_month" => $request->to_month,
            "to_date" => $request->to_date,
        ]);
        DB::commit();
        // return response
        // ...
    }

    public function update( Request $request, $id ) {
        $company = $this->work->company;
        $position = $this->work->position;
        DB::beginTransaction();
        if($company->name != $request->company) {
            $existCompany = Company::firstWhere('name', $request->company);
            if(is_null($existCompany)) {
                $company->update(['name' => $request->company]);
            } else {
                $company->delete();
                $company = $existCompany;
            }
        }
        if($position->name != $request->position) {
            $existPosition = Position::firstWhere('name', $request->position);
            if(is_null($existPosition)) {
                $position->update(['name' => $request->position]);
            } else {
                $position->delete();
                $position = $existPosition;
            }
        }
        $this->work->update([
            "company_id" => $company->id,
            "position_id" => $position->id,
            "from_year" => $request->from_year,
            "from_month" => $request->from_month,
            "from_date" => $request->from_date,
            "to_year" => $request->to_year,
            "to_month" => $request->to_month,
            "to_date" => $request->to_date,
        ]);
        DB::commit();
        // return response
        // ...
    }

    public function destroy( Request $request, $id ) {
        $company = $this->work->company;
        $position = $this->work->position;
        DB::beginTransaction();
        if($company->member_count == 1) {
            $company->delete();
        }
        if($position->member_count == 1) {
            $position->delete();
        }
        $this->work->delete();
        DB::commit();
        // return response
        // ...
    }
}
