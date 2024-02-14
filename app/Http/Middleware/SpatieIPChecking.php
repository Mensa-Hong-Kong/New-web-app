<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SpatieIPChecking
{
    public function handle(Request $request, Closure $next ) {
        $apiIPs = Http::get( config( "stripe.apiIPs" ) );
        $armadaGatorIPs = Http::get( config( "stripe.armadaGatorIPs" ) );
        $webhookIPs = Http::get( config( "stripe.webhookIPs" ) );
        if( !$apiIPs->ok() || !$armadaGatorIPs->ok() || $webhookIPsIP->ok() ) {
            abort( 503 );
        }
        $allowIPs = array_merge(
            $apiIPs[ config( "stripe.apiArrayKey" ) ],
            $armadaGatorIPs[ config( "stripe.armadaGatorArrayKey" ) ],
            $webhookIPs[ config( "stripe.webhookArrayKey" ) ],
        );
        if( in_array( $request->ip(), $allowIPs ) ) {
            return $next($request);
        }
        abort( 403 );
    }
}
