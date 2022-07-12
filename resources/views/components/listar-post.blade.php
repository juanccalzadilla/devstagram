<div class="flex flex-col items-center rounded-lg">
    @forelse ($posts as $post)
    <div style="background-image: url({{asset('uploads').'/'.$post->imagenUrl}});" class="mb-10 p-10 shadow-lg max-w-6xl rounded-2xl ">
        <div class="md:flex items-center">
            <a class="w-full lg:w-1/2" href="{{route('posts.show', ['post' => $post, 'user' => $post->user])}}">
                <img src="{{asset('uploads').'/'.$post->imagenUrl}}" class="w-full" alt="Imagen del post {{$post->titulo}}">             
            </a>
              
              <div class="lg:flex lg:flex-col lg:justify-center lg:items-center w-full lg:w-1/2 ">
                  <p class="text-white text-xl text-center">{{'@'.$post->user->username}}</p>
                  <p class="text-white text-xl text-center">{{$post->titulo}}</p>
  
                  <div class="bg-white w-full lg:w-8/12 mx-1 lg:mx-1 p-10 my-10 rounded-lg">
                      @forelse ($post->limitarComentarios($post->comentarios) as $comentario)
                      <span class="text-sm  text-gray-400"><a class="text-gray-600" href="{{route('posts.index',['user' => $comentario->user])}}">{{'@'.$comentario->user->username}}</a> - {{$comentario->created_at->diffForHumans()}} </span>
                      <p>{{$comentario->comentario}}</p>
                      <hr class="my-1">
                      @empty
                       <p class="text-center text-sm text-gray-600 uppercase">No hay comentarios aun</p>
                      @endforelse
  
                      @if ($post->comentarios->count() > 4)
                      <a class="text-center text-sm text-gray-600 uppercase my-2" href="{{route('posts.show', ['post' => $post, 'user' => $post->user])}}">Ver todos los comentarios</a>
                      @endif
                  </div>
  
  
              </div>
        </div>
    </div>
  
    @empty
      <p class="text-center text-lg text-gray-600 uppercase">No hay publicaciones aun</p>
    @endforelse
  </div>