<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    // PARA CERRAR SESION 
    public function store()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
