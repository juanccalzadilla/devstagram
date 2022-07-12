<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request,Post $post)
    {
        $post->likes()->create(['user_id' => auth()->id()]);
        return back();
    }

    
    public function destroy(Request $request,Post $post)
    {
        $post->likes()->where('user_id', auth()->id())->delete();
        return back();
    }

}
