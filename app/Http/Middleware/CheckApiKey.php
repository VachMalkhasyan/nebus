<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApiKey
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY');
        if ($apiKey == "64cc901c-dfd8-4d60-9380-1b333baf5bd4") {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
