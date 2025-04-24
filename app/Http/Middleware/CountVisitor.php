<?php

namespace App\Http\Middleware;

use App\Settings\GeneralSettings;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CountVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (!session()->has('has_visited')) {
        //     session(['has_visited' => true]);

            $settings = setting();
            
            $settings->visitor_count += 1;
            $settings->save();

        // }
        return $next($request);
    }
}
