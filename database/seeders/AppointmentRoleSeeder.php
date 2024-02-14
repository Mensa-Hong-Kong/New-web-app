<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member\AppointmentRole;

class AppointmentRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppointmentRole::insert([
            [ "name" => "Chairman" ],
            [ "name" => "Vice Chairman" ],
            [ "name" => "Honorary Secretary" ],
            [ "name" => "Honorary Treasurer" ],
            [ "name" => "Director" ],
            [ "name" => "Convenor" ],
            [ "name" => "Deputy Convenor" ],
            [ "name" => "Member" ],
        ]);
    }
}
