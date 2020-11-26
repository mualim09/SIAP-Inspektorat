<?php

namespace App\Http\Middleware;

use Closure;

class CheckUser
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
        if (auth()->check() && auth()->user()->user_status == 'nonaktif') {         
            $message = 'Mohon maaf, status Kepegawaian anda NONAKTIF, anda tidak diperkenankan LOGIN ke dalam sistem.';
            auth()->logout();     
            return redirect()->route('login')->withMessage($message); 
        }
        return $next($request);
    }
}
