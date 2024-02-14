<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CustomPage;

class CustomPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomPage::insert([
            [
                "name" => "Milestone",
                "path" => route( "about-us.milestone" ),
            ],
            [
                "name" => "Constitution",
                "path" => route( "about-us.milestone" ),
            ],
            [
                "name" => "Board of Directors",
                "path" => route( "about-us.board-of-directors" ),
            ],
            [
                "name" => "Committees",
                "path" => route( "about-us.committees" ),
            ],
            [
                "name" => "News",
                "path" => route( "news.index" ),
            ],
            [
                "name" => "Event",
                "path" => route( "events.index" ),
            ],
            [
                "name" => "Admission Test",
                "path" => route( "admission-test" ),
            ],
            [
                "name" => "Member List",
                "path" => route( "member" ),
            ],
            [
                "name" => "Shop",
                "path" => route( "shop.products" ),
            ],
            [
                "name" => "Contact Us",
                "path" => route( "contact-us" ),
            ],
        ]);
    }
}
