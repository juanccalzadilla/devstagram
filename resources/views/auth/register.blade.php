@extends('layouts.app')
@section('contenido')
    <div class="md:flex justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12  ">
            <img src="{{asset('img/registrar.jpg')}}" alt="Imagen de registro" >
        </div>
        <div class="md:w-4/12  bg-white p-10 rounded-md shadow-md">
            <h4 class="text-3xl font-bold mb-4 text-gray-800 text-center">
                Registro Devstagram
            </h4>
            <hr class="mb-4">
            <form action="{{route('register')}}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input type="text" id="name" name="name" placeholder="Tu nombre" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" value="{{old('name')}}">
                    @error('name')
                        <span class="text-red-500 text-sm">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input type="text" id="username" name="username" placeholder="Tu nombre de usuario" class="border p-3 w-full rounded-lg  @error('username') border-red-500 @enderror" value="{{old('username')}}">
                    @error('username')
                     <span class="text-red-500 text-sm">{{$message}}</span>
                    @enderror
                </div>
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
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Confirma tu contraseña
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite tu contraseña" class="border p-3 w-full rounded-lg">
                </div>

                <button type="submit" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white ">Crear Cuenta</button>
            </form>

        </div>
    </div>
@endsection