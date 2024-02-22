<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class AccountResetToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->route( "user" );
        $token = $request->route( "token" );
        $reset = User::with( "reset" )
            ->findOrFail( $id )
            ->reset;
        $timeLimit = env( "RESET_TIME_LIMIT", 5 );
        $tokenTime = strtotime( $reset[ "created_at" ] );
        $deadline = strtotime( "+$timeLimit minutes", $tokenTime );
        if(
            $reset[ "token" ] == $token &&
            $deadline >= time() &&
            $reset[ "status" ] == "0"
        ) {
            return $next($request);
        }
        abort( 401 );
    }
}
