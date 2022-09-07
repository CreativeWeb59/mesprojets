<?php
 
namespace App\Http\Middleware;
 
use Closure;
 
class CheckStatus
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
        if (auth()->user()->role_id == 2) {
            return $next($request);
        }
            return response()->view('pages.home'); // retour page d'accueil si utilisateur pas admin
            //return response()->json('Your account is inactive');
    }
}
