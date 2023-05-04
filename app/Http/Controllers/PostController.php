<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        /**sirve para ver si el usuario esta autenticado y con excepto es para contenidos que si se 
         * se pueden ver
         */
        $this->middleware(('auth'))->except(['show', 'index']);
    }

    /** Como estamos pasando una variable en las rutas debemos importar el modelo User para
     * utilizar la variable. Video 86
     */
    public function index(User $user)
    {

        /**2.  filtar este paso es despues. Sirve para traer los posts.
         * Hay que pasar la variable $post a la vista.
         * Para mostrar informacion en la vista podemos utilizar la llave (posts).
         * Con esto podremos mostrar las publicaciones en el dashboard
        */
        // $post = Post::where('user_id', $user->id)->get();
        // $post = Post::where('user_id', $user->id)->paginate(20);
        $post = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(20);

        /**1. Con dd() podemos saber si estamos pasando algo */
        // dd($user->username);

        /** para pasar los datos de la bd es necesario pasar la variable $user en el return 
         * luego te vas en dasboard. Video 87
         */
        return view('dashboard', [
            'user' => $user,
            'posts' => $post
        ]);
    }

    public function create()
    {
        // dd('Creando post..');
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // dd('Creando publicacion');
        /** Validacion de la imagen */
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        // ALMECENANDO LA IMAGEN A LA BASE DE DATOS
        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        /** la forma de almacenar datos relacionales es de la siguiente manera */
        // $request->user()->posts()->create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);



        /** Si te sales un error esque necesitas ir al modelo de de Post */
        return redirect()->route('posts.index', auth()->user()->username);
    }

    // fuincion para mostrar informacion de una sola foto
    public function show(User $user ,Post $post)
    {

        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        // dd('Elimindo: ' , $post->id);
        $post->delete();

        //Eliminar la imagen
        $imagen_path = public_path('uploads/' . $post->imagen);
        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }
        return redirect()->route('posts.index', auth()->user()->username);
    }
}