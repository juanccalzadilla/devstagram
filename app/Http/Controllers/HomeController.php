<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {

        // Obtener a quienes seguimos
        $followers = auth()->user()->following->toArray();
        // Obtener el id de cada follower
        $followerIds = array_column($followers, 'id');

        
        $posts = Post::whereIn('user_id', $followerIds)
            ->latest()->get();
        return view('home',[
            'posts' => $posts
        ]);

        
    }
}
