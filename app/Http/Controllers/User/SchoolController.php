<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User\School;
use App\Models\User\SchoolGrade;
use App\Models\User\HasSchool;

class SchoolController extends Controller
{
    private $school;
    public function __construct()
    {
        $this->middleware(
            function($request, $next) {
                $this->school = HasSchool::with([
                    'school' => function($query) {
                        $query->withCount('users');
                    },
                    'fromGrade' => function($query) {
                        $query->withCount('users');
                    },
                    'toGrade' => function($query) {
                        $query->withCount('users');
                    },
                ])->findOrFail($request->get('school'));
                if($this->school['user_id'] != Auth::id()) {
                    return abort(403);
                }
                return $next($request);
            }
        )->except('store');
    }
    public function store( Request $request ) {
        DB::beginTransaction();
        $school = School::findOrCreate(['name' => $request->school]);
        $fromGradeID = "";
        $toGradeID = "";
        if(!empty($request->from_grade)) {
            $fromGradeID = SchoolGrade::findOrCreate(['name' => $request->from_grade])->id;
        }
        if(!empty($request->to_grade)) {
            $toGrade = SchoolGrade::findOrCreate(['name' => $request->to_grade])->id;
        }
        HasSchool::create([
            "user_id" => $request->user_id,
            "school_id" => $school->id,
            "from_year" => $request->from_year,
            "from_mouth" => $request->from_mouth,
            "from_date" => $request->from_date,
            "to_year" => $request->to_year,
            "to_mouth" => $request->to_mouth,
            "to_date" => $request->to_date,
            "from_grade_id" => $fromGradeID,
            "to_grade_id" => $toGradeID,
        ]);
        DB::commit();
        // return response
        // ...
    }

    public function update( Request $request, $id ) {
        $school = $this->school->school;
        $fromGrade = $this->school->fromGrade;
        $toGrade = $this->school->toGrade;
        $fromGradeID = "";
        $toGradeID = "";
        if($school->name != $request->school) {
            if($school->users_count == 1) {
                $existSchool = School::firstWhere('name', $request->school);
                if(is_null($existSchool)) {
                    $school->update(['name' => $request->school]);
                } else {
                    $school->delete();
                    $school = $existSchool;
                }
            } else {
                $school = School::findOrCreate(['name' => $request->school]);
            }
        }
        if(!empty($request->from_grade)) {
            if($fromGrade->name != $request->from_grade) {
                if($fromGrade->users_count == 1) {
                    $existFromGrade = SchoolGrade::firstWhere('name', $request->from_grade);
                    if(is_null($existFromGrade)) {
                        $fromGrade->update(['name' => $request->from_grade]);
                    } else {
                        $fromGrade->delete();
                        $fromGrade = $existFromGrade;
                    }
                } else {
                    $fromGrade = SchoolGrade::findOrCreate(['name' => $request->from_grade]);
                }
            }
            $fromGradeID = $fromGrade->id;
        }
        if(!empty($request->to_grade)) {
            if($toGrade->name != $request->to_grade) {
                if($toGrade->users_count == 1) {
                    $existToGrade = SchoolGrade::firstWhere('name', $request->to_grade);
                    if(is_null($existToGrade)) {
                        $toGrade->update(['name' => $request->to_grade]);
                    } else {
                        $toGrade->delete();
                        $toGrade = $existToGrade;
                    }
                } else {
                    $toGrade = SchoolGrade::findOrCreate(['name' => $request->to_grade]);
                }
            }
            $toGradeID = $toGrade->id;
        }
        $this->school->update([
            "school_id" => $school->id,
            "from_year" => $request->from_year,
            "from_mouth" => $request->from_mouth,
            "from_date" => $request->from_date,
            "to_year" => $request->to_year,
            "to_mouth" => $request->to_mouth,
            "to_date" => $request->to_date,
            "from_grade_id" => $fromGradeID,
            "to_grade_id" => $toGradeID,
        ]);
        DB::beginTransaction();
        // return response
        // ...
    }

    public function destroy( $id ) {
        $school = $this->school->school;
        $fromGrade = $this->school->fromGrade;
        $toGrade = $this->school->toGrade;
        DB::beginTransaction();
        if($school->users_count == 1) {
            $school->delete();
        }
        if($fromGrade->users_count == 1) {
            $fromGrade->delete();
        }
        if($toGrade->users_count == 1) {
            $toGrade->delete();
        }
        $this->school->delete();
        DB::commit();
        // return response
        // ...
    }
}
