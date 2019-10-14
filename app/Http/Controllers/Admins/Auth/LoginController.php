<?php
namespace App\Http\Controllers\Admins\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{
    use ThrottlesLogins;


    // Máximo de tentativas de login permitidas.
    public $maxAttempts = 4;

    // Número de minutos para bloquear o login.
    public $decayMinutes = 2;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function username(){
        return 'email';
    }

    public function showLoginForm()
    {
        return view('auth.login',[
            'title' => 'Admin Login',
            'loginRoute' => 'admin.login',
            'forgotPasswordRoute' => 'admin.password.request',
        ]);
    }

    public function login(Request $request)
    {
        //Validação...
        $this->validator($request);
        // Verifica se o usuário tem muitas tentativas de login.
        if ($this->hasTooManyLoginAttempts($request)){
            // Dispare o evento de bloqueio.
            $this->fireLockoutEvent($request);
            // Redireciona o usuário de volta após o bloqueio.
            return $this->sendLockoutResponse($request);
        }
        // Tenta fazer login.
        if(Auth::guard('admin')->attempt($request->only('email','password'),$request->filled('remember'))){
            //Autenticado
            return redirect()
                ->intended(route('admin.home'))
                ->with('status','Você está logado como administrador!');
        }
        // acompanha as tentativas de login do usuário.
        $this->incrementLoginAttempts($request);
        // Falha na autenticação
        return $this->loginFailed();
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/')->with('status', ' Usuário desconectado!');
    }

    private function validator(Request $request)
    {
        // Regras de validação.
        $rules = [
            'email'    => 'required|email|exists:admins|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];
        // Mensagens de erro de validação personalizadas.
        $messages = [
            'email.exists' => 'Essas credenciais não correspondem aos nossos registros.',
        ];
        // Valida a solicitação.
        $request->validate($rules,$messages);
    }

    private function loginFailed()
    {
        return redirect()
            ->back()
            ->withInput()
            ->with('error','O login falhou, tente novamente!');
    }
}
