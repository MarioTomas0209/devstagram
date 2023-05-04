<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
/** para tener la sesion siempre iniciada pudes utilizar  dd($request->remember);*/

        // VALIDACION PARA EL LOGIN
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        // SI ES TRUE EL USUARIO ES AUTENTICADO
        return redirect()->route('posts.index', auth()->user()->username);
        /** En la ruta de post.idex esta esperando una variable por lo tanto hay que agragarle 
         * lo siguiente auth()->user()->username. video 92
         */
    }
}
