<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class SpecialInterestsGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SpecialInterestsGroup::insert([
            [ "team_id" => 5 ],
            [ "team_id" => 6 ],
            [ "team_id" => 7 ],
            [ "team_id" => 8 ],
            [ "team_id" => 9 ],
            [ "team_id" => 10 ],
            [ "team_id" => 11 ],
            [ "team_id" => 12 ],
            [ "team_id" => 13 ],
        ]);
    }
}
