<?php

use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgerPasswordController;

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
$pages = Page::where( "limit", 0 )
    ->whereNotNull( "path" )
    ->get();
foreach( $pages as $page ) {
    Route::get( $path, "PageController@show" )
        ->name( "about-us" )
        ->default( "pageID", $page[ "id" ] );
}
Route::get('/', function () {
        return view("index");
    })->name( "index" );
Route::get( "/about-us", "PageController@show" )
    ->name( "about-us" )
    ->defaults( "pageID", 1 );
Route::get( "about-us/milestone", "PageController@milestone" )
    ->name( "about-us.milestone" );
Route::get( "about-us/board-of-directors", "PageController@boardOfDirectors" )
    ->name( "about-us.board-of-directors" );
Route::get( "about-us/committees", "PageController@committees" )
    ->name( "about-us.committees" );
Route::resource( "/news", NewsController::class )
    ->only( [ "index", "show" ] );
Route::resource( "/events", EventController::class )
    ->except( [ "destroy" ] );
Route::get( "/events/{event}/join", "JoinEventController@create" );
Route::post( "/events/{event}/join", "JoinEventController@store" );
Route::delete( "/events/{event}/cancel", "JoinEventController@destroy" );
Route::resource( "/events/{event}/registered-users", EventUserController::class );
Route::resource( "/admission-test", AdmissionTestController::class )
    ->only( [ "index",  "store", "destroy" ] );
Route::resource( "/admission-test/order", AdmissionTestOrderController::class )
    ->only( [ "index",  "store", "destroy" ] );
Route::resource( "/members", MemberController::class )
    ->only( [ "index", "show" ] );
Route::resource( "/shop/products", ProductController::class )
    ->only( [ "index", "show" ] )
    ->names(  );
Route::get( "/privileges", "PageController@show" )
    ->name( "privileges" );
Route::get( "/frequently-asked-question", "PageController@frequentlyAskedQuestion" )
    ->name( "frequently-asked-question" );
Route::get( "/contact-us", "PageController@contactUs" )
    ->name( "contact-us" );
Route::get( "/forget-password", "ForgerPasswordController@create" )
    ->name( "forget-password.create" );
Route::post( "/forget-password", "ForgerPasswordController@store" )
    ->name( "forget-password.store" );
Route::get( "/login", "AuthController@index" )
    ->name( "login" );
Route::post( "/login", "AuthController@login" )
    ->name( "auth" );
Route::get( "/register", "AuthController@create" )
    ->name( "register.create" );
Route::post( "/register", "AuthController@store" )
    ->name( "register.store" );
Route::middleware( "auth" )->group(
    function() {
        // user
        Route::get( "/logout", "AuthController@logout" )
            ->name( "logout" );
        $pages = Page::where( "limit", "!=", 0 )
            ->whereNotNull( "path" )
            ->get();
        foreach( $pages as $page ) {
            Route::get( $path, "PageController@show" )
                ->default( "pageID", $page[ "id" ] );
        }
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
        Route::singleton( "/profile", UserController::class );
        Route::resource( "/address", AddressController::class )
            ->except( [ "index", "create", "edit" ] );
        Route::resource( "/address", AddressController::class )
            ->except( [ "index", "create", "edit" ] );
        Route::resource( "/profile/notifications", NotificationController::class )
            ->only( [ "index", "update" ] );
        Route::prefix( "admin" )->name( "admin." )->middleware( "role:administrator" )->group(
            function() {
                // admin
                Route::get( "/", "AdministrationController@index" );
                Route::get( "/check-in/{user}", "AdmissionTestController@checkIn" );
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
            }
        );
    }
);
