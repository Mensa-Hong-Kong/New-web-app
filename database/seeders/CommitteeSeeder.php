<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Committee;

class CommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Committee::insert([
            [ "team_id" => 2 ],
            [ "team_id" => 3 ],
            [ "team_id" => 4 ],
        ]);
    }
}
