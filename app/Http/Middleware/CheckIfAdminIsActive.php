<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIfAdminIsActive
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->role === 'admin' && $user->is_active == 1) {
            return $next($request);
        }

        return redirect()->route('notActive')->withErrors([
            'error' => 'Votre compte n’est pas actif ou vous n’avez pas les droits d’administrateur.',
        ]);
    }
}
