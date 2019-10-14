<?php
namespace App\Http\Controllers\Managers\Auth;

use Auth;
use Password;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:manager');
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email',[
            'title' => 'Manager Password Reset',
            'passwordEmailRoute' => 'manager.password.email'
        ]);
    }

    public function broker()
    {
        return Password::broker('managers');
    }

    public function guard()
    {
        return Auth::guard('manager');
    }
}
