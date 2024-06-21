<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Member\Appointment;
use App\Models\Member\Organize;
use App\Models\Member\Team;
use App\Models\Member\AppointmentRole;

class AppointmentController extends Controller
{
    private $appointment;
    public function __construct() {
        $this->middleware(
            function($request, $next) {
                $this->appointment = Appointment::with([
                    'organize' => function($query) {
                        $query->withCount('members');
                    },
                    'team' => function($query) {
                        $query->withCount('members');
                    },
                    'role' => function($query) {
                        $query->withCount('members');
                    },
                ])->whereFirst($request->get('appointment'));
                if(
                    !$this->appointment['organize']['is_limit'] &&
                    $this->appointment['member_id'] == Auth::user()->member()->id
                ) {
                    return $next($request);
                }
                return abort(403);
            }
        )->except('store');
    }

    public function store( Request $request ) {
        DB::beginTransaction();
        $organize = Organize::findOrCreate(['name' => $request->organize]);
        $team = Team::findOrCreate(['name' => $request->team]);
        $role = AppointmentRole::findOrCreate(['name' => $request->role]);
        Appointment::create([
            "member_id" => Auth::user()->member()->id,
            "organize_id" => $organize->id,
            "team_id" => $team->id,
            "role_id" => $role->id,
            "from_year" => $request->from_year,
            "from_mouth" => $request->from_mouth,
            "from_date" => $request->from_date,
            "to_year" => $request->from_year,
            "to_mouth" => $request->from_mouth,
            "to_date" => $request->from_date,
        ]);
        DB::commit();
        // return response
        // ...
    }

    public function update(Request $request, $id) {
        $appointment = $this->appointment;
        $organize = $appointment->organize;
        $team = $appointment->team;;
        $role = $appointment->role;;
        DB::beginTransaction();
        if($organize->name != $request->organize) {
            if($appointment->organize->member_count == 1) {
                $existOrganize = Organize::firstWhere('name', $request->association);
                if(is_null($existOrganize)) {
                    $organize->update(['name' => $request->organize]);
                } else {
                    $organize->delete();
                    $organize = $existOrganize;
                }
            } else {
                $organize = Organize::findOrCreate(['name' => $request->organize]);
            }
        }
        if($team->name != $request->team) {
            if($appointment->team->member_count == 1) {
                $existTeam = Team::firstWhere('name', $request->association);
                if(is_null($existTeam)) {
                    $team->update(['name' => $request->team]);
                } else {
                    $team->delete();
                    $team = $existTeam;
                }
            } else {
                $team = Team::findOrCreate(['name' => $request->team]);
            }
        }
        if($role->name != $request->role) {
            if($appointment->role->member_count == 1) {
                $existRole = AppointmentRole::firstWhere('name', $request->association);
                if(is_null($existRole)) {
                    $role->update(['name' => $request->role]);
                } else {
                    $role->delete();
                    $role = $existRole;
                }
            } else {
                $role = AppointmentRole::findOrCreate(['name' => $request->role]);
            }
        }
        $appointment->update([
            "organize_id" => $organize->id,
            "team_id" => $team->id,
            "role_id" => $role->id,
            "from_year" => $request->from_year,
            "from_mouth" => $request->from_mouth,
            "from_date" => $request->from_date,
            "to_year" => $request->from_year,
            "to_mouth" => $request->from_mouth,
            "to_date" => $request->from_date,
        ]);
        DB::commit();
        // return response
        // ...
    }

    public function destroy( $id ) {
        $appointment = $this->appointment;
        DB::beginTransaction();
        if($appointment->organize->member_count == 1) {
            $appointment->organize->delete();
        }
        if($appointment->team->member_count == 1) {
            $appointment->team->delete();
        }
        if($appointment->role->member_count == 1) {
            $appointment->role->delete();
        }
        $appointment->delete();
        DB::commit();
        // return response
        // ...
    }
}
