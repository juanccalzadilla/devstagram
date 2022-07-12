<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comentario;

class FullPost extends Component
{

    public $post;
    public $isLiked;
    public $user;
    public $likes;

    public $comentario;

    public $comentarios;

    public function mount($post)
    {
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $post->likes()->count();
        $this->comentarios = $post->comentarios()->get();
    }

    public function render()
    {
        return view('livewire.full-post');
    }

    public function like()
    {
        if ($this->post->checkLike(auth()->user())) {
            $this->post->likes()->where('user_id', auth()->id())->delete();
            $this->isLiked = false;
            $this->likes = $this->likes - 1;
        } else {
            $this->post->likes()->create(['user_id' => auth()->id()]);
            $this->likes = $this->likes + 1;
            $this->isLiked = true;

        }
    }

    public function comentar(){
        Comentario::create([
            'comentario' => $this->comentario,
            'user_id' => auth()->id(),
            'post_id' => $this->post->id
        ]);

        // Limpiar el formulario
        $this->comentario = '';
        $this->comentarios = $this->post->comentarios()->get();
    }
}
