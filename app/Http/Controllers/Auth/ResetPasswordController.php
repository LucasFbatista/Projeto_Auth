<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{

    use ResetsPasswords;

    protected $redirectTo = '/home';

    public function showResetForm(Request $request, $token = null){
        return view('auth.passwords.reset',[
            'title' => 'Reset Password',
            'passwordUpdateRoute' => 'password.update',
            'token' => $token,
        ]);
    }

}
