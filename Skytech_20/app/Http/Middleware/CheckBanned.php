<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_banned) {
            $is_banned = auth()->user()->is_banned;
            auth()->logout();

            if ($is_banned == true) {
                $message = 'Jūsų paskyra yra deaktyvuota.';
            }

            return redirect()->route('login')->withMessage($message);
        }

        return $next($request);
    }
}
