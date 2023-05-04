<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        // dd(auth()->user()->username);
        // VALIDAR
        $this->validate($request ,[
            'comentario' => 'required|max:255'
        ]);
        // ALMACENAR EL MENSAJE
        Comentario::create([
            'user_id' => auth()->user()->id, //Con eso podemos comentar con el usuario autenticado
            'post_id' => $post->id,
            'comentario' => $request->comentario
        ]);
        // IMPRIMIR UN MENSAJE
        return back()->with('mensaje', 'Comentario Publicado');
    }
}
