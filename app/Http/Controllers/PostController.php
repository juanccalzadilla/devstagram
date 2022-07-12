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
        $this->middleware('auth')->except(['index', 'show']);
    }
    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->paginate(20);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }


    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagenUrl' => 'required'
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagenUrl' => $request->imagenUrl,
            'user_id'   => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }


    public function show(User $user, Post $post)
    {

        return view('posts.show', ['post' => $post, 'user' => $user]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        // Eliminar la imagen del post
        $imagenDeletePath = public_path('uploads/' . $post->imagenUrl);

        if (File::exists($imagenDeletePath)) {
            unlink($imagenDeletePath);
        }

        

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
