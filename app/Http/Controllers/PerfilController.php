<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        // dd('Mostrando el formulario para editar perfil');
        // vamos a mostrar una vista.
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username, '.auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
            'email' => ['required', 'unique:users,email, '.auth()->user()->id , 'email', 'max:60'],
        ]);
        if($request->password)
        {
            $this->validate($request, [
                'password' => ['confirmed', 'min:6'],
                'password_actual' => ['required']
            ]);

            if(!auth()->attempt(['email' => auth()->user()->email, 'password' => $request->password_actual]))
            {
                return back()->with('mensaje', 'Ingresá correctamente tu contraseña actual.');
            }
        }
       
        if($request->imagen)
        {
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();
    
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);
    
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        if($request->password)
        {
            $usuario->password = Hash::make($request->password);
        }
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }

}
