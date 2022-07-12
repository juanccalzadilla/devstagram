@extends('layouts.app')
@section('titulo')
 {{$post->titulo}}
@endsection

@section('contenido')
<div class="md:flex justify-center md:gap-10 md:items-center">
    <div class="md:w-6/12  ">
        <img src="{{asset('uploads').'/'. $post->imagenUrl }}" alt="Imagen del post" >
    </div>

    <livewire:full-post :post="$post" :user="$user">
</div>
@endsection