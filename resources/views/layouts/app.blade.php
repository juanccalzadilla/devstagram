<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @stack('styles')
        <title>Devstagram - @yield('titulo')</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <script src="{{asset('js/app.js')}}"></script>
        @livewireStyles
    </head>
    <body style="background-image: url({{asset('img/bodypattern.webp')}})">
        <header class="p-5 bg-teal-500 shadow">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-black">
                    @auth
                   <a href="{{route('home')}}" class="text-white">Devstagram</a> 
                   @endauth
                   @guest
                   <a href="{{route('login')}}" class="text-white">Devstagram</a> 
                   @endguest
                </h1>
                @auth
                <a href="{{route('posts.create')}}" class="flex items-center gap-2 bg-teal-300 text-white p-2 rounded-md shadow-md cursor-pointer hover:bg-teal-400 transition-colors text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sm" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Crear nueva publicacion
                </a>
                @endauth
                <nav class="flex gap-2 items-center">
                    @guest
                    <a class="font-bold uppercase text-white text-sm" href="{{route('login')}}">Login</a>
                    <a class="font-bold uppercase text-white text-sm" href="{{ route('register') }}">Crear cuenta</a>
                    @endguest
                    @auth
                    <p class="text-white">Hola, <span class="font-normal"><a class="text-white" href="{{route('posts.index',auth()->user()->username)}}">{{auth()->user()->username}}</a></span></p>
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="font-bold uppercase text-white text-sm">Cerrar Sesión</button>
                    </form>
                    @endauth
                </nav>
            </div>
        </header>

        <main class="container mx-auto mt-10">
            <h2 class="font-black text-white text-ellipsis text-center text-3xl mb-10">
                @yield('titulo')
            </h2>
            @yield('contenido')
        </main>

        <footer class="text-center mt-10 p-5 text-white font-bold uppercase">
            DevsTagram - Todos los derechos resevados - {{now()->year}}
        </footer> 
        @livewireScripts
    </body>
</html>
