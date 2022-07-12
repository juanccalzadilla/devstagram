@extends('layouts.app')
@section('contenido')
    <div class="md:flex justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12  ">
            <img src="{{asset('img/login.jpg')}}" alt="Imagen de login" >
        </div>
        <div class="md:w-4/12  bg-white p-10 rounded-md shadow-md">
            <h4 class="text-3xl font-bold mb-4 text-gray-800 text-center">
                Incia sesión en Devstagram
            </h4>
            <hr class="mb-4">
            <form method="POST" action="{{route('login')}}">
                @csrf
                @if(session('mensaje'))
                <span class="text-red-500 text-sm">{{session('mensaje')}}</span>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input type="email" id="email" name="email" placeholder="Tu email de registro" class="border p-3 w-full rounded-lg  @error('email') border-red-500 @enderror" value="{{old('email')}}">
                    @error('email')
                        <span class="text-red-500 text-sm">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña
                    </label>
                    <input type="password" id="password" name="password" placeholder="Tu contraseña" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <span class="text-red-500 text-sm">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember" id="rememberCheck"> 
                    <label for="rememberCheck"> Mantener sesión abierta</label>
                </div>
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white ">Iniciar Sesión</button>
            </form>

        </div>
    </div>
@endsection