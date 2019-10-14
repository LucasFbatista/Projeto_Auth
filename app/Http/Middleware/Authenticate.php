<?php

namespace App\Http\Middleware;

use Route;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    //AQUI NOSSO MIDDLEWARE IRÁ VERIFICAR SE O USUÁRIO É ADMIN, MANAGER E USER E DIRECIONAR PARA ROTA
    //DE ACORDO COM O TIPO DE USUÁRIO ANTES DE CHEGAR AO CONTROLLER..
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if(Route::is('admin.*')){
                return route('admin.login');
            }
            if(Route::is('manager.*')){
                return route('manager.login');
            }
            return route('login');
        }
    }
}
