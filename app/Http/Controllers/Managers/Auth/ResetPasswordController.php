<?php

namespace App\Http\Controllers\Managers\Auth;

use Auth;
use Password;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{

    use ResetsPasswords;

    protected $redirectTo = '/manager/dashboard';

    public function __construct()
    {
        $this->middleware('guest:manager');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset',[
            'title' => 'Reset Manager Password',
            'passwordUpdateRoute' => 'manager.password.update',
            'token' => $token,
        ]);
    }

    protected function broker()
    {
        return Password::broker('managers');
    }

    protected function guard()
    {
        return Auth::guard('manager');
    }
}
