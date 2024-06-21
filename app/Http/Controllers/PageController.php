<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Page;
use App\Models\Milestone;
use Route;
use App\Models\Member\Appointment;
use App\Models\FrequentlyAskedQuestion;
use App\Models\Contact;

class PageController extends Controller
{
    public function index() {
        $news = News::all();
        return view("page.index")
            ->with( "news", $news );
    }

    public function milestone() {
        $milestone = Milestone::all();
        return view("page.milestone")
            ->with( "milestone", $milestone );
    }

    public function boardOfDirectors() {
        $appointments = Appointment::with( "member.user", "role" )
            ->whereHas(
                "organize", function( $query ) {
                    $query->where( "id", 1 );
                }
            )->whereHas(
                "team", function( $query ) {
                    $query->where( "id", 1 );
                }
            )->orderBy( "to" )
            ->orderBy( "from" );
        $appointmentHistory = clone $appointments;
        $appointments = $appointments
            ->where( "to", ">", now() )
            ->get();
        $appointmentHistory = $appointmentHistory
            ->where( "to", "<=", now() )
            ->get();
        return view("page.boardOfDirectors")
            ->with( "appointments", $appointments )
            ->with( "appointmentHistory", $appointmentHistory );
    }

    public function committees() {
        $appointments = Appointment::with( "member.user", "role" )
            ->whereHas(
                "organize", function( $query ) {
                    $query->where( "id", 1 );
                }
            )->whereHas( "systemTeam.committee" )->where( "to", ">", now() )
            ->orderBy( "to" )
            ->orderBy( "from" );
        $appointmentHistory = clone $appointments;
        $appointments = $appointments
            ->where( "to", ">", now() )
            ->get();
        $appointmentHistory = $appointmentHistory
            ->where( "to", "<=", now() )
            ->get();
        return view("page.committees")
            ->with( "appointments", $appointments )
            ->with( "appointmentHistory", $appointmentHistory );
    }

    public function frequentlyAskedQuestion() {
        $frequentlyAskedQuestion = FrequentlyAskedQuestion::orderBy( "order_number" )
            ->get();
        return view("page.frequentlyAskedQuestion")
            ->with( "frequentlyAskedQuestion", $frequentlyAskedQuestion );
    }

    public function contactUs() {
        $contacts = Contact::orderBy( "order_number" )
            ->get();
        return view("page.contactUs")
            ->with( "contacts", $contacts );
    }
}
