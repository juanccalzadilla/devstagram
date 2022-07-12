<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{

    public $post;
    public $isLiked;

    public function mount($post)
    {
        $this->isLiked = $post->checkLike(auth()->user());
    }

    public function render()
    {
        return view('livewire.like-post');
    }



}
