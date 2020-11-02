<?php

namespace App\Http\Middleware;

use Closure;
use App\Campus;

class DeleteCampus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->campus->programs->count() > 0) {
            return response()->json([
                'message' => 'You cannot delete this campus because there are programs associated with this campus.'
            ]);
        }

        return $next($request);
    }
}
