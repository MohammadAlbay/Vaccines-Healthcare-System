<?php

namespace App\Http\Middleware;

use App\Common;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecureRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isGuest = Common::isGuest();

        //Log::info("user is $isGuest");
        if($isGuest) {
            if($request->ajax() || $request->wantsJson()) {
                return response()->json(["message" => "User Unauthorized. access denied"]);
            } else {
                return redirect("/");
            }
        }
        return $next($request);
    }
}
