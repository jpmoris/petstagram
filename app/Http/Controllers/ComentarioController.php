<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class ComentarioController extends Controller
{

    public function store(Request $request, User $user, Post $post)
    {
        // Validar
        $this->validate($request, [
            'comentario' => 'required|max:255'
        ]);
        // Almacenar

        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario,
        ]);

        // Imprimir un msg
        return back()->with('mensaje', 'Comentario realizado con éxito');
    }
}
