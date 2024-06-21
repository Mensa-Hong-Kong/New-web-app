<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Member\Association;
use App\Models\Member\OtherMembershipType;
use App\Models\Member\HasOtherMembership;

class OtherMembershipsController extends Controller
{
    private $otherMembership;
    public function __construct() {
        $this->middleware(
            function($request, $next) {
                $this->otherMembership = HasOtherMembership::with([
                    'association' => function($query) {
                        $query->withCount('members');
                    },
                    'type' => function($query) {
                        $query->withCount('members');
                    },
                ])->findOrFail($request->get('otherMembership'));
                if($this->otherMembership['member_id'] == Auth::user()->member()->id) {
                    return $next($request);
                }
                return abort(403);
            }
        )->except('store');
    }
    public function store( Request $request ) {
        DB::beginTransaction();
        $association = Association::findOrCreate(['name' => $request->association]);
        $type = OtherMembershipType::findOrCreate(['name' => $request->type]);
        HasOtherMembership::create([
            'member_id' => Auth::user()->member()->id,
            'association_id' => $association->id,
            'type_id' => $type->id,
            'from_year' => $request->from_year,
            'from_month' => $request->from_month,
            'from_date' => $request->from_date,
            'to_year' => $request->to_year,
            'to_month' => $request->to_month,
            'to_date' => $request->to_date,
        ]);
        DB::commit();
        // return response
        // ...
    }

    public function update( Request $request, $id ) {
        $otherMembership = $this->otherMembership;
        $association = $otherMembership->association;
        $type = $otherMembership->type;
        DB::beginTransaction();
        if($association->name != $request->association) {
            if($association->members_count == 1) {
                $existAssociation = Association::firstWhere('name', $request->association);
                if(is_null($existAssociation)) {
                    $association->update(['name' => $request->association]);
                } else {
                    $association->delete();
                    $association = $existAssociation;
                }
            } else {
                $association = Association::findOrCreate(['name' => $request->type]);
            }
        }
        if($type->name != $request->type) {
            if($type->members_count == 1) {
                $existType = OtherMembershipType::firstWhere('name', $request->type);
                if(is_null($existType)) {
                    $type->update(['name' => $request->type]);
                } else {
                    $type->delete();
                    $type = $existType;
                }
            } else {
                $type = OtherMembershipType::findOrCreate(['name' => $request->type]);
            }
        }
        $otherMembership->update([
            'association_id' => $association->id,
            'type_id' => $type->id,
            'from_year' => $request->from_year,
            'from_month' => $request->from_month,
            'from_date' => $request->from_date,
            'to_year' => $request->to_year,
            'to_month' => $request->to_month,
            'to_date' => $request->to_date,
        ]);
        DB::commit();
        // return response
        // ...
    }

    public function destroy( $id ) {
        $otherMembership = $this->otherMembership;
        DB::beginTransaction();
        if($otherMembership->association->member_count == 1) {
            $otherMembership->association->delete();
        }
        if($otherMembership->type->member_count == 1) {
            $otherMembership->type->delete();
        }
        $otherMembership->delete();
        DB::commit();
        // return response
        // ...
    }
}
