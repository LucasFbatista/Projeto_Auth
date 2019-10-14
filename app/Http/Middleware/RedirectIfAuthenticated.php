<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{

    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if($guard == "admin"){

                // o usuário foi autenticado com o administrador.
                return redirect()->route('admin.home');

            }elseif($guard == "manager") {

                // o usuário foi autenticado com a proteção do gerente.
                return redirect()->route('manager.home');

            }else{

                 // guarda user padrão.
                 return redirect()->route('home');

            }
        }
        return $next($request);

    }
}


