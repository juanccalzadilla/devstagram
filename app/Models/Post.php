<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagenUrl',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }


    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    public function limitarComentarios($comentarios)
    {
        return $comentarios->take(4);
    }

}
