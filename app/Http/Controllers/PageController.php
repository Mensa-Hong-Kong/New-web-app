<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Milestone;
use App\Models\News;
use Route;

class PageController extends Controller
{
    public function index() {
        $news = News::all();
        return view("page.index")
            ->with( "news", $news );
    }
    public function show() {
        $page = c::where( "route_name", Route::currentRouteName() )
            ->findOrFail();
        return view("page.show")
            ->with( "page.show", $page );
    }
    public function milestone() {
        $milestone = Milestone::all();
        return view("milestone")
            ->with( "page.milestone", $milestone );
    }
}
