<div class="md:w-4/12 bg-white p-10 rounded-md shadow-md">
    @if(session('success'))

    <p class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">{{session('success')}}</p>
    @endif
    <span class="text-sm text-gray-400">{{'@'.$post->user->username}} - {{$post->created_at->diffForHumans()}} -
        {{$likes}} {{Str::plural('Me gusta',$likes)}}</span>
    <p class="text-2xl font-bold uppercase text-gray-500">{{$post->titulo}}</p>
    <hr>
    <p class="mt-3 mb-3">{{$post->descripcion}}</p>

    <div class="mt-4">

        <p class="text-center text-xl font-bold uppercase text-gray-500">Comentarios</p>

        <div class="caja">
            @if ($post->comentarios->count())
            @foreach ($comentarios as $comentario)

            <span class="text-sm  text-gray-400"><a class="text-gray-600"
                    href="{{route('posts.index',['user' => $comentario->user])}}">{{'@'.$comentario->user->username}}</a>
                - {{$comentario->created_at->diffForHumans()}} </span>
            <p>{{$comentario->comentario}}</p>
            <hr class="my-1">

            @endforeach
            @else
            <p class="text-center font-bold text-sm text-gray-500 uppercase my-4">No hay comentarios</p>
            @endif
        </div>
        @auth

        <div class="comentar">
            <textarea id="comentario" wire:model="comentario" name="comentario" placeholder="Haz un comentario!!"
                class="border p-3 w-full my-3 rounded-lg @error('comentario') border-red-500 @enderror"></textarea>
            <button wire:click="comentar"
                class="bg-amber-500 hover:bg-amber-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white ">Comentar</button>
            <button wire:click="like"
                class="bg-red-400 hover:bg-red-500 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white mt-3 flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="{{$isLiked ? " red" : "none" }}"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </button>
            @auth
            @if (auth()->user()->id == $post->user->id)
            <form action="{{route('posts.destroy', $post)}}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" name="eliminar"
                    class="bg-red-200 hover:bg-red-300 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white mt-3 flex justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Eliminar publicación
                </button>
            </form>
            @endif
            @endauth
        </div>
        @endauth

        @guest
        <p class="text-center text-sm mt-2 text-gray-500"><a href="{{route('login')}}" class="font-black">Inicia
                sesión</a> o <a class="font-black" href="{{route('register')}}">registrate</a> para hacer un comentario!
        </p>
        @endguest

    </div>
</div>