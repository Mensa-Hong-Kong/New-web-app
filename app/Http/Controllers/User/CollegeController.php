<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User\College;
use App\Models\User\CollegeConcentration;
use App\Models\User\CollegeCertificateType;
use App\Models\User\HasCollege;

class CollegeController extends Controller
{
    private $college;
    public function __construct()
    {
        $this->middleware(
            function($request, $next) {
                $userID = Auth::id();
                $this->college = HasCollege::with([
                        'college' => function($query) {
                            $query->withCount('users');
                        },
                        'firstConcentration' => function($query) {
                            $query->withCount('firstConcentrationUsers')
                                ->withCount('secondConcentrationUsers')
                                ->withCount('thirdConcentrationUsers');
                        },
                        'secondConcentration' => function($query) {
                            $query->withCount('firstConcentrationUsers')
                                ->withCount('secondConcentrationUsers')
                                ->withCount('thirdConcentrationUsers');
                        },
                        'thirdConcentration' => function($query) {
                            $query->withCount('firstConcentrationUsers')
                                ->withCount('secondConcentrationUsers')
                                ->withCount('thirdConcentrationUsers');
                        },
                        'type' => function($query) {
                            $query->withCount('users');
                        },
                    ])
                    ->findOrFail($request->get('college'));
                if($this->college['user_id'] != Auth::id()) {
                    return abort(403);
                }
                return $next($request);
            }
        )->except('store');
    }
    public function store( Request $request ) {
        DB::beginTransaction();
        $concentration1 = CollegeConcentration::findOrCreate(['name' => $request->concentration[1]]);
        $concentration2 = CollegeConcentration::findOrCreate(['name' => $request->concentration[2]]);
        $concentration3 = CollegeConcentration::findOrCreate(['name' => $request->concentration[3]]);
        $type = CollegeCertificateType::findOrCreate(['name' => $request->certificate_type]);
        $college = College::findOrCreate(['name' => $request->college]);
        HasCollege::create([
            "user_id" => Auth::user()->id,
            "college_id" => $college->id,
            "from_year" => $request->from_year,
            "from_mouth" => $request->from_mouth,
            "from_date" => $request->from_date,
            "to_year" => $request->to_year,
            "to_mouth" => $request->to_mouth,
            "to_date" => $request->to_date,
            "concentration1_id" => $concentration1->id,
            "concentration2_id" => $concentration2->id,
            "concentration3_id" => $concentration3->id,
            "type_id" => $type->id,
        ]);
        DB::commit();
        // return response
        // ...
    }

    public function update( Request $request, $id ) {
        $college = $this->college->college;
        $firstConcentration = $this->college->firstConcentration;
        $secondConcentration = $this->college->secondConcentration;
        $thirdConcentration = $this->college->thirdConcentration;
        $type = $this->college->type;
        DB::beginTransaction();
        if($firstConcentration->name != $request->concentration[1]) {
            if(
                $firstConcentration->firstConcentrationUsers == 1 &&
                $firstConcentration->secondConcentrationUsers == 0 &&
                $firstConcentration->thirdConcentrationUsers == 0
            ) {
                $existConcentration = CollegeConcentration::firstWhere('name', $request->concentration[1]);
                if(is_null($existConcentration)) {
                    $firstConcentration->update([['name' => $request->concentration[1]]]);
                } else {
                    $firstConcentration->delete();
                    $firstConcentration = $existConcentration;
                }
            } else {
                $firstConcentration = CollegeConcentration::findOrCreate(['name' => $request->concentration[1]]);
            }
        }
        if($secondConcentration->name != $request->concentration[2]) {
            if(
                $secondConcentration->firstConcentrationUsers == 0 &&
                $secondConcentration->secondConcentrationUsers == 1 &&
                $secondConcentration->thirdConcentrationUsers == 0
            ) {
                $existConcentration = CollegeConcentration::firstWhere('name', $request->concentration[2]);
                if(is_null($existConcentration)) {
                    $secondConcentration->update([['name' => $request->concentration[2]]]);
                } else {
                    $secondConcentration->delete();
                    $secondConcentration = $existConcentration;
                }
            } else {
                $secondConcentration = CollegeConcentration::findOrCreate(['name' => $request->concentration[2]]);
            }
        }
        if($thirdConcentration->name != $request->concentration[3]) {
            if(
                $thirdConcentration->firstConcentrationUsers == 0 &&
                $thirdConcentration->secondConcentrationUsers == 0 &&
                $thirdConcentration->thirdConcentrationUsers == 1
            ) {
                $existConcentration = CollegeConcentration::firstWhere('name', $request->concentration[3]);
                if(is_null($existConcentration)) {
                    $thirdConcentration->update([['name' => $request->concentration[3]]]);
                } else {
                    $thirdConcentration->delete();
                    $thirdConcentration = $existConcentration;
                }
            } else {
                $thirdConcentration = CollegeConcentration::findOrCreate(['name' => $request->concentration[3]]);
            }
        }
        if($type->name != $request->type) {
            if($type->users_count == 1) {
                $existType = CollegeCertificateType::firstWhere('name', $request->certificate_type);
                if(is_null($existType)) {
                    $type->update([['name' => $request->type]]);
                } else {
                    $type->delete();
                    $type = $existType;
                }
            } else {
                $type = CollegeCertificateType::findOrCreate(['name' => $request->certificate_type]);
            }
        }
        if($college->users_count == 1) {
            $existCollege = College::firstWhere('name', $request->college);
            if(is_null($existCollege)) {
                $college->update([['name' => $request->college]]);
            } else {
                $college->delete();
                $college = $existCollege;
            }
        } else {
            $college = College::findOrCreate(['name' => $request->college]);
        }
        $this->college->update([
            "college" => $college->id,
            "from_year" => $request->from_year,
            "from_mouth" => $request->from_mouth,
            "from_date" => $request->from_date,
            "to_year" => $request->to_year,
            "to_mouth" => $request->to_mouth,
            "to_date" => $request->to_date,
            "concentration1_id" => $firstConcentration->id,
            "concentration2_id" => $secondConcentration->id,
            "concentration3_id" => $thirdConcentration->id,
            "type_id" => $type->id,
        ]);
        DB::commit();
        // return response
        // ...
    }

    public function destroy( $id ) {
        $college = $this->college->college;
        $firstConcentration = $this->college->firstConcentration;
        $secondConcentration = $this->college->secondConcentration;
        $thirdConcentration = $this->college->thirdConcentration;
        $type = $this->college->type;
        DB::beginTransaction();
        if($college->users_count == 1) {
            $college->delete();
        }
        if(
            $firstConcentration->firstConcentrationUsers == 1 &&
            $firstConcentration->secondConcentrationUsers == 0 &&
            $firstConcentration->thirdConcentrationUsers == 0
        ) {
            $firstConcentration->delete();
        }
        if(
            $secondConcentration->firstConcentrationUsers == 0 &&
            $secondConcentration->secondConcentrationUsers == 1 &&
            $secondConcentration->thirdConcentrationUsers == 0
        ) {
            $secondConcentration->delete();
        }
        if(
            $thirdConcentration->firstConcentrationUsers == 0 &&
            $thirdConcentration->secondConcentrationUsers == 0 &&
            $thirdConcentration->thirdConcentrationUsers == 1
        ) {
            $thirdConcentration->delete();
        }
        if($type->users_count == 1) {
            $type->delete();
        }
        $this->college->delete();
        DB::commit();
        // return response
        // ...
    }
}
