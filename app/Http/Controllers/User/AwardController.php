<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User\Award;

class AwardController extends Controller
{
    private $userID;
    private $award;
    public function __construct() {
        $this->middleware(
            function($request, $next) {
                $userID = Auth::id();
                $this->award = Award::withCount('users')
                    ->whereHas(
                        'users', function($query) use($userID) {
                            $query->where('id', $userID);
                        }
                    )
                    ->findOrFail($request->get('award'));
                if(
                    is_null($this->award) ||
                    $this->award->is_limit
                ) {
                    return abort(403);
                }
                $this->userID = $userID;
                return $next($request);
            }
        )->except('store');
    }
    public function store( Request $request ) {
        DB::beginTransaction();
        Award::findOrCreate(['name' => $request->name])
            ->users()->attach([
                Auth::id() => [
                    "issue_year" => $request->issue_year,
                    "issue_month" => $request->issue_month,
                    "issue_date" => $request->issue_date,
                ]
            ]);
        DB::commit();
        // return response
        // ...
    }

    public function update(Request $request, $id) {
        $award = $this->award;
        $data = [
            $this->userID => [
                "issue_year" => $request->issue_year,
                "issue_month" => $request->issue_month,
                "issue_date" => $request->issue_date,
            ]
        ];
        DB::beginTransaction();
        if(
            $award->users_count == 1 &&
            $award->name != $request->name
        ) {
            $existAward = Award::firstWhere('name', $request->name);
            if(is_null($existAward)) {
                $award->update(['name' => $request->name]);
                $award->users()->sync($data);
            } else {
                $award->delete();
                $existAward->users()->attach($data);
            }
        } else {
            $award->users()->detach(Auth::id());
            Award::findOrCreate(['name' => $request->name])
                ->users()->attach($data);
        }
        DB::commit();
        // return response
        // ...
    }

    public function destroy( $id ) {
        $award = $this->award;
        if($award->users_count == 1) {
            DB::beginTransaction();
            $award->detach();
            $award->delete();
            DB::commit();
        } else {
            $award->detach($this->userID);
        }
        // return response
        // ...
    }
}
