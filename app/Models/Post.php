<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    /** necesitas agregar lo siguiente para poder almacenar en la base de datos */
    protected $fillable = ['titulo', 'descripcion', 'imagen', 'user_id'];

    // METODO DE (UNO A UNO) UN POST SOLO PETERNECE A UN USUARIO\
    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'username']);
        /** con el ->select(['name', 'username'])  es para decir que datos requerimos*/
    }

    /**UN POST(PUBLICACION) PUEDE TENER MUCHOS COMENTARIOS UNO A MUCHOS */
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    /** se va hacer una relacion de un post con un like un post puede tener mucho likes */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Para eviatar likes repetido
    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
}
