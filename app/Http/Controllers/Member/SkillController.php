<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Member\SkillType;
use App\Models\Member\Skill;

class SkillController extends Controller
{
    private $memberID;
    private $skill;
    public function __construct()
    {
        $this->middleware(
            function($request, $next) {
                $memberID = Auth::user()->member()->id;
                $this->skill = Skill::with([
                        'type' => function($query) {
                            $query->withCount('skills');
                        },
                        'members' => function($query) use($memberID) {
                            $query->where('id', $memberID);
                        }
                    ])->findOrFail($request->get('skill'));
                if(is_null($this->skill['members'])) {
                    return abort(403);
                }
                $this->memberID = $memberID;
                return $next($request);
            }
        )->except('store');
    }

    private function findOrCreateSkillAndType($request, $memberID) {
        $type = SkillType::findOrCreate(['name' => $request->type]);
        Skill::findOrCreate([
            'name' => $request->skill,
            'type_id' => $type->id,
        ])->members()->attach($memberID);
    }
    public function store( Request $request ) {
        DB::beginTransaction();
        $this->findOrCreateSkillAndType($request, Auth::user()->member()->id);
        DB::commit();
        // return response
        // ...
    }

    public function update( Request $request, $id ) {
        $skill = $this->skill;
        $type = $skill->type;
        DB::beginTransaction();
        if(
            $skill->name != $request->skill ||
            $type->name != $request->type
        ) {
            if($skill->members_count == 1) {
                if($type->name != $request->type) {
                    if($type->skills_count == 1) {
                        $existType = SkillType::firstWhere('name', $request->type);
                        if(is_null($existType)) {
                            $type->update(['name' => $request->type]);
                        } else {
                            $type->delete();
                            $type = $existType;
                        }
                    } else {
                        $type = SkillType::findOrCreate(['name' => $request->type]);
                    }
                }
                $existSkill = Skill::firstWhere([
                    'name' => $request->name,
                    'type_id' => $type->id,
                ]);
                if(is_null($existSkill)) {
                    $skill->update(['name' => $request->name]);
                } else {
                    $skill->delete();
                    $existSkill->members()->attach($this->memberID);
                }
            } else {
                $this->findOrCreateSkillAndType($request, $this->memberID);
            }
        }
        // return response
        // ...
    }

    public function destroy( Request $request, $id ) {
        $skill = $this->skill;
        $type = $skill->type;
        if($skill->members_count == 1) {
            DB::beginTransaction();
            if($type->skills_count == 1) {
                $type->delete();
            }
            $skill->delete();
            DB::commit();
        } else {
            $skill->members()->detach($this->memberID);
        }
        // return response
        // ...
    }
}
