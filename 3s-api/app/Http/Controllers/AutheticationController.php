<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AutheticationController extends Controller
{
    /**
     * Mostra o formulário de login
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    /**
     * Realiza login com os dados enviados
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {

        $data = $request->validate([
            'login' => ['required'],
            'password' => ['required']
        ]);

        $dataAPi = ['login' => $data['login'], 'senha' => $data['password']];
        $response = Http::post(env('UNILAB_API_ORIGIN') . '/authenticate', $dataAPi);

        $responseJ = json_decode($response->body());

        $userId  = 0;

        if (isset($responseJ->id)) {
            $userId = intval($responseJ->id);
        }
        if ($userId === 0) {
            return back()->withErrors([
                'email' => 'O email e/ou senha não são invalidos'
            ]);
        }

        $headers = [
            'Authorization' => 'Bearer ' . $responseJ->access_token,
        ];
        $response = Http::withHeaders($headers)->get(env('UNILAB_API_ORIGIN') . '/user', $headers);
        $responseJ2 = json_decode($response->body());

        $response = Http::withHeaders($headers)->get(env('UNILAB_API_ORIGIN') . '/bond', $headers);
        $responseJ3 = json_decode($response->body());


        $user = User::updateOrCreate(
            ['id' => $userId],
            [
                'id' => $userId,
                'name' => $responseJ2->nome,
                'email' => $responseJ2->email,
                'login' => $responseJ2->login,
                'division_sig' => $responseJ3[0]->sigla_unidade,
                'password' => $data['password']
            ]
        );

        if($user->role === null) {
            $user->role = $responseJ2->id_status_servidor != 1 ? 'disabled' : 'customer';
            $user->save();
        }


        if (Auth::attempt($data, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'O email e/ou senha não são invalidos'
        ]);
    }

    /**
     * Realiza logout do usuário
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
