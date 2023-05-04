<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // CREACION DE TABLAS RELACIONES (DE UNO A MUCHOS) UN USUARIO TIENE MUCHOS POSTS
    public function posts()
    {
        return $this->hasMany(Post::class);
        /** en alguno casos que no sigas la convenciones de laravel por ejemplo en la migracion de 
         * post tu cambnien el no nombre laravel no va a saber que id agarrar pero aqui le puedes 
         * decir a laravel con lo siguiente return $this->hasMany(Post::class, id_autor);
         */
    }
    
    // RELACION CON LA TABLA DE LIKES
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Metodo que almacena los seguidores de un usuario
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    //Metodo que almacena los que seguimos
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    public function siguiendo(User $user)
    {
        return $this->followers->contains( $user->id );
    }



}
