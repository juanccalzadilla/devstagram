<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class PerfilController extends Controller
{

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {

        $request->request->add(['username' => Str::slug($request->username)]);
        $request->validate([
            'username' => ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20','not_in:editar-perfil,configuracion,register,login,logout,posts,posts.create,posts.store,posts.show,posts.destroy,comentarios.store,likes.store,likes.destroy'],
            'email' => ['required','email','unique:users,email,'.auth()->user()->id],
        ]);
        if (!empty($request->password)) {
            $request->validate([
                'password' => ['min:6','max:20'],
                'password_new' => ['required','min:6','max:20']
            ]);
        }

        // Permitir cambiar la contraseña solo si sabe la contraseña actual
        if (isset($request->password)) {
            $new_password = Hash::make($request->password_new);
        }

        if ($request->password) {
            if (!Hash::check($request->password, auth()->user()->password)) {
                unset($new_password);
            }
        }

        if ($request->imagen) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid().".". $imagen->extension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000,1000);
            $imagenPath = public_path('profilesImages') .'/'. $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        // Guardar cambios
        $imagenAlternativa = auth()->user()->imagen ? auth()->user()->imagen : null;

        // Borrar la imagen antigua si se esta cambiando
        if ($imagenAlternativa != null && $request->imagen) {
            $imagenAlternativa = public_path('profilesImages') .'/'. $imagenAlternativa;
            if (File::exists($imagenAlternativa)) {
                unlink($imagenAlternativa);
            }
        }

        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        if (isset($new_password)) {
            $usuario->password = $new_password;
        }
        $usuario->imagen = $nombreImagen ?? $imagenAlternativa;
        $usuario->save();

        // Redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }
}
