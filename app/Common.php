<?php

namespace App;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Common
{
    /**
     * check if current request is from a logged-in user
     */
    public static function isGuest() {
        return Auth::guest() || Auth::guard(null)->guest();
    }
    /**
     * automatically picks the right respond based on the request object
     * @param \Illuminate\Http\Request $request
     * @param mixed $routeResponse
     * @param mixed $jsonResponse
     * @return mixed
     */
    public static function respons(Request $request, $routeResponse, $jsonResponse)  {
        if($request->wantsJson() || $request->ajax())
            return response()->json(["State" => 0, "Code" => 0, "Message" => $jsonResponse]);
        else
            return $routeResponse;
    }

    /**
     * response for an error happened or a logical error. automatically picks the right response
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\RedirectResponse|string|null $route
     * @param mixed $errors
     * @return mixed|RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public static function responseError(Request $request, RedirectResponse|string|null $route, $errors) {
        if($request->wantsJson() || $request->ajax())
            return response()->json(["State" => 1, "Code" => 1, "Message" => $errors]);
        else {
            if($route instanceof RedirectResponse)
                return $route->with("error", $errors);
            else if(is_string($route))
                return redirect($route)->with("error", $errors);
            else
                return redirect()->back()->with("error", $errors);
        }
    }
}