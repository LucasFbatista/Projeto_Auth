<?php
namespace App\Http\Controllers\Admin\Auth;
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
        $this->middleware('guest:admin');
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email',[
            'title' => 'Admin Password Reset',
            'passwordEmailRoute' => 'admin.password.email'
        ]);
    }

    public function broker(){
        return Password::broker('admins');
    }

    public function guard(){
        return Auth::guard('admin');
    }
}
