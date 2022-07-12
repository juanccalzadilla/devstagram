@extends('layouts.app')
@section('titulo')
Mi Perfil
@endsection
@section('contenido')

<div class="md:flex md:justify-center">
    <div class="md:w-1/2 bg-white shadow p-6 rounded-lg">
        <form action="{{route('perfil.store')}}" enctype="multipart/form-data" method="POST" class="mt-10 md:mt-0">
            @csrf
            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                    Username
                </label>
                <input type="text" id="username" name="username" placeholder="Tu nombre de usuario" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value="{{auth()->user()->username}}">
                @error('username')
                    <span class="text-red-500 text-sm">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                    Email
                </label>
                <input type="email" id="email" name="email" placeholder="Tu email de registro" class="border p-3 w-full rounded-lg  @error('email') border-red-500 @enderror" value="{{auth()->user()->email}}">
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
                <label for="password_new" class="mb-2 block uppercase text-gray-500 font-bold @error('password_new') border-red-500 @enderror">
                    Nueva contraseña
                </label>
                <input type="password" id="password_new" name="password_new" placeholder="Nueva contraseña" class="border p-3 w-full rounded-lg">
                @error('password_new')
                <span class="text-red-500 text-sm">{{$message}}</span>
            @enderror
            </div>

            <div class="mb-5">
                <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                    Imagen perfil
                </label>
                <input type="file" id="imagen" name="imagen"  accept=".jpg,.jpeg,.png" class="border p-3 w-full rounded-lg" />
            </div>
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white ">Guardar cambios</button>
        </form>
    </div>
</div>
@endsection