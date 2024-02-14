<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::insert([
            [
                "path" => "about-us",
                "title" => "About Us",
            ],
            [
                "path" => "constitution",
                "title" => "Constitution",
            ],
            [
                "path" => "privileges",
                "title" => "Privileges",
            ],
            [
                "path" => "terms-of-service",
                "title" => "Terms of Service",
            ],
            [
                "path" => "privacy-policy",
                "title" => "Privacy Policy",
            ],
            [
                "path" => "Disclaimer",
                "title" => "disclaimer",
            ],
        ]);
    }
}
