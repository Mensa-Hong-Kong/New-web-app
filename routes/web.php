<?php

use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Models\CustomPage;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventUserController;
use App\Http\Controllers\AdmissionTestController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ShopController;
use App\Http\Middleware\AccountResetToken;
use App\Http\Controllers\Auth\ForgerPasswordController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\Controller as UserController;
use App\Http\Controllers\User\EmailController;
use App\Http\Controllers\User\MobileController;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\WorkController;
use App\Http\Controllers\User\CollegeController;
use App\Http\Controllers\User\SchoolController;
use App\Http\Controllers\User\AwardController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\Member\ContactController;
use App\Http\Controllers\Member\CertificationController;
use App\Http\Controllers\Member\CertificateController;
use App\Http\Controllers\Member\OtherMembershipsController;
use App\Http\Controllers\Member\AppointmentController;
use App\Http\Controllers\Member\SkillController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\NavigationController as AdminNavigationController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\AdmissionTestController as AdminAdmissionTestController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\AwardController as AdminAwardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::view("/", "index");;
Route::get( "/about-us", "PageController@show" )
    ->name( "about-us" )
    ->defaults( "pageID", 1 );
Route::get( "about-us/milestone", "PageController@milestone" )
    ->name( "about-us.milestone" );
Route::get( "about-us/board-of-directors", "PageController@boardOfDirectors" )
    ->name( "about-us.board-of-directors" );
Route::get( "about-us/committees", "PageController@committees" )
    ->name( "about-us.committees" );
/*
Route::resource( "/news", NewsController::class )
    ->only( [ "index", "show" ] );
Route::resource( "/events", EventController::class )
    ->except( [ "destroy" ] );
Route::get( "/events/{event}/join", "JoinEventController@create" );
Route::post( "/events/{event}/join", "JoinEventController@store" );
Route::delete( "/events/{event}/cancel", "JoinEventController@destroy" );
Route::resource( "/events/{event}/users", EventUserController::class );
Route::controller( AdmissionTestController::class )
    ->group(
        function () {
            Route::get('/', 'index');
            Route::get('/order', 'show');
            Route::post('/order', 'store');
        }
    );
*/
Route::resource( "/members", MemberController::class )
    ->only( [ "index", "show" ] );
/*
Route::resource( "/shop/products", ShopController::class )
    ->only( [ "index", "show" ] )
    ->names( "shop.products" );
*/
Route::get( "/frequently-asked-question", "PageController@frequentlyAskedQuestion" )
    ->name( "frequently-asked-question" );
Route::get( "/contact-us", "PageController@contactUs" )
    ->name( "contact-us" );
Route::get( "/login", "AuthController@index" )
    ->name( "login" );
Route::post( "/login", "AuthController@login" )
    ->name( "auth" );
Route::get( "/register", "AuthController@create" )
    ->name( "register" );
Route::post( "/register", "AuthController@store" )
    ->name( "register" );
Route::get( "/forget-password", "ForgerPasswordController@create" )
    ->name( "forget-password" );
Route::post( "/forget-password", "ForgerPasswordController@store" );
Route::middleware( [ AccountResetToken::class ] )->group(
    function() {
        Route::get( "/forget-password/{user}/{token}", [ ForgerPasswordController::class, "edit" ] )
            ->name( "forget-password.reset" );
        Route::match( [ "put", "patch" ], "/forget-password/{user}/{token}", [ AuthController::class, "reset" ] );
    }
);
Route::middleware( "auth" )->group(
    function() {
        // user
        Route::get( "/logout", "AuthController@logout" )
            ->name( "logout" );
        /*
        Route::resource( "/cart", CartController::class )
            ->except( [ "create", "show", "edit" ] );
        Route::get( "/check-out", "OrderController@create" )
            ->name( "orders.create" );
        Route::resource( "/orders", OrderController::class )
            ->only( [ "index", "store", "show" ] );
        Route::get( "/paying/success", "OrderController@success" )
            ->name( "orders.success" );
        Route::get( "/paying/failed", "OrderController@failed" )
            ->name( "orders.failed" );
        */
        Route::singleton( "/profile", UserController::class );
        Route::resource( "/profile/emails", EmailController::class )
            ->only( [ "store", "update", "destroy" ] );
        Route::resource( "/profile/mobiles", MobileController::class )
            ->only( [ "store", "update", "destroy" ] );
        Route::resource( "/profile/addresses", AddressController::class )
            ->except( [ "index", "create", "edit" ] );
        Route::resource( "/profile/notifications", NotificationController::class )
            ->only( [ "index", "update" ] );
        Route::resource( "/profile/works", WorkController::class )
            ->except( [ "index", "create", "edit" ] );
        Route::resource( "/profile/colleges", CollegeController::class )
            ->except( [ "index", "create", "edit" ] );
        Route::resource( "/profile/schools", SchoolController::class )
            ->except( [ "index", "create", "edit" ] );
        Route::resource( "/profile/awards", AwardController::class )
            ->except( [ "index", "create", "edit" ] );
        Route::middleware( "role:Member" )->group(
            function() {
                Route::resource( "/profile/contacts", ContactController::class )
                    ->only( [ "store", "update", "destroy" ] );
                Route::resource( "/profile/certifications", CertificationController::class )
                    ->only( [ "store", "update", "destroy" ] );
                Route::resource( "/profile/certificates", CertificateController::class )
                    ->except( [ "index", "create", "edit" ] );
                Route::resource( "/profile/other-memberships", OtherMembershipsController::class )
                    ->except( [ "index", "create", "edit" ] );
                Route::resource( "/profile/appointments", AppointmentController::class )
                    ->except( [ "index", "create", "edit" ] );
                Route::resource( "/profile/skills", SkillController::class )
                    ->except( [ "index", "create", "edit" ] );
            }
        );
        Route::prefix( "admin" )->name( "admin." )->middleware( "role:Administrator" )->group(
            function() {
                // admin
                Route::get( "/", [ AdminController::class, "index" ] );
                Route::resource( "/users", AdminUserController::class )
                    ->except( [ "show", "destroy" ] );
                Route::singleton( "/navigation", AdminNavigationController::class );
                Route::resource( "/news", AdminNewsController::class )
                    ->except( [ "show", "destroy" ] );
                Route::resource( "/events", AdminEventController::class )
                    ->except( [ "show", "destroy" ] );
                Route::resource( "/pages", AdminPageController::class )
                    ->except( [ "show", "destroy" ] );
                Route::resource( "/shop/products", AdminProductController::class )
                    ->except( [ "show", "destroy" ] );
                Route::resource( "/admission-test", AdminAdmissionTestController::class )
                    ->except( [ "show", "destroy" ] );
                Route::get( "/admission-test/check-in/{user}", [ AdminAdmissionTestController::class, "checkIn" ] );
                Route::resource( "/appointments", AdminAppointmentController::class )
                    ->only( [ "index", "update" ] );
                Route::resource( "/awards", AdminAwardController::class )
                    ->only( [ "index", "update" ] );
            }
        );
    }
);
