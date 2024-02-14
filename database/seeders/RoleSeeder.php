<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert = [
            [
                "name" => "Chairman",
                "team_id" => 1,
                "appointment_role_id" => 1,
            ],
            [
                "name" => "Vice Chairman",
                "team_id" => 1,
                "appointment_role_id" => 2,
            ],
            [
                "name" => "Honorary Secretary",
                "team_id" => 1,
                "appointment_role_id" => 3,
            ],
            [
                "name" => "Honorary Treasurer",
                "team_id" => 1,
                "appointment_role_id" => 4,
            ],
            [
                "name" => "Director",
                "team_id" => 1,
                "appointment_role_id" => 5,
            ],
        ];
        foreach( range( 2, 13 ) as $teamID ) {
            $insert[] = [
                "name" => "Convenor",
                "team_id" => $teamID,
                "appointment_role_id" => 6,
            ];
            $insert[] = [
                "name" => "Deputy Convenor",
                "team_id" => $teamID,
                "appointment_role_id" => 7,
            ];
            $insert[] = [
                "name" => "Member",
                "team_id" => $teamID,
                "appointment_role_id" => 8,
            ];
        }
        Role::insert( $insert );
    }
}
