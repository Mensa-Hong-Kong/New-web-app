<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::insert([
            // 1
            [ "name" => "Board od Directors" ],
            // 2
            [ "name" => "Event Organizing Committee" ],
            // 3
            [ "name" => "Branding and Communication Committee" ],
            // 4
            [ "name" => "Internal Publications Committee" ],
            // 5
            [ "name" => "Chess" ],
            // 6
            [ "name" => "Dream" ],
            // 7
            [ "name" => "Entrepreneur Development" ],
            // 8
            [ "name" => "LARP & TRPG" ],
            // 9
            [ "name" => "MBN Business Networking" ],
            // 10
            [ "name" => "Mystic" ],
            // 11
            [ "name" => "Poker" ],
            // 12
            [ "name" => "Sofiesta" ],
            // 13
            [ "name" => "Wildlife Go!" ],
        ]);
    }
}
