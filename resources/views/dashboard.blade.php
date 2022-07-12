@extends('layouts.app')

@section('titulo')
Perfil: {{$user->name}}
@endsection

@section('contenido')

<div class="bg-white p-10 rounded-xl shadow-xl">
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:6/12 md:flex bg-gray-50 shadow-lg p-4">
            <div class="sm:8/12 md:w-6/12 p-5">
                @if($user->imagen == null)
                <img src="{{asset('img/usuario.svg')}}" alt="SVG USER PROFILE">
                @else
                <img src="{{asset('profilesImages').'/'.$user->imagen}}" class="rounded-full" alt="Imagen del usuario">
                @endif
            </div>
            <div class="w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:items-start md:justify-center py-10 md:py-10">
                <div class="flex items-center gap-2 mb-3">
                    <p class="text-gray-700 text-2xl">{{$user->username}}</p>
                    @auth
                        @if ($user->id == auth()->user()->id)
                            <a href="{{route('perfil.index')}}"class="text-sm text-gray-500 hover:text-gray-600 cursor-pointer">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                              </svg>
                            </a>  
                        @endif
                    @endauth
                </div>
                @auth
                @if (auth()->user()->id != $user->id && !($user->checkFollower(auth()->user())))
                <form class="w-full" action="{{route('users.follow',$user)}}" method="POST">
                    @csrf
                    <button type="submit" class="flex justify-center my-3 bg-emerald-500 text-white text-center py-2 px-3 w-1/2 transition-colors hover:bg-emerald-600 rounded-lg ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Seguir
                    </button>
                </form>
                @endif
    
                @if (auth()->user()->id != $user->id && ($user->checkFollower(auth()->user())))
                <form class="w-full" action="{{route('users.unfollow',$user)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center justify-center my-3 bg-red-500 text-white text-center py-2 px-3 w-1/2 transition-colors hover:bg-red-600 rounded-lg ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                          </svg>
                        Dejar de seguir
                    </button>
                </form>   
                @endif
                @endauth
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$user->followers->count()}}
                    <span class="font-normal">
                        @choice('Seguidor|Seguidores',$user->followers->count())
                    </span>
                </p>
    
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$user->following->count()}}
                    <span class="font-normal">
                        Siguiendo
                    </span>
                </p>
    
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$posts->count()}}
                    <span class="font-normal">
                        publicaciones
                    </span>
                </p>
            </div>
        </div>
    </div>
    
    <section class="mx-auto mt-10">
        <h2 class="text-4xl text-center font-blak my-10"> Publicaciones</h2>
        @if ($posts->count() == 0 )
        <p class="text-center text-lg text-gray-600 uppercase">No hay publicaciones aun</p>
        @endif
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
    
            @foreach ($posts as $post)
                <div class="">
                    <a href="{{route('posts.show', ['post' => $post, 'user' => $user])}}">
                        <img src="{{asset('uploads').'/'.$post->imagenUrl}}" alt="Imagen del post {{$post->titulo}}">             
                    </a>
                </div>
            @endforeach
    
        </div>
        <div class="my-10 ">
            {{$posts->links('pagination::tailwind')}}
        </div>
    </section>
</div>

@endsection