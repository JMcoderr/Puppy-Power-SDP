<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// middleware that blocks non-admin users from reaching protected routes
class AdminOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        // check that the user is logged in AND has the is_admin flag set
        if (! $request->user() || ! $request->user()->is_admin) {
            // return 403 so the user knows they are not allowed here
            abort(403);
        }

        // user passed the check, continue to the next middleware / controller
        return $next($request);
    }
}
