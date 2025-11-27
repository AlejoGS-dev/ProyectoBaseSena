<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class InicioController extends Controller
{
    public function index(Request $request)
    {
        // Lo que viene del buscador del navbar
        $texto = trim($request->get('texto', ''));

        // Query base de posts
        $postsQuery = Post::with('user')->latest();

        // Colección de usuarios (para resultados de personas)
        $users = collect();

        if ($texto !== '') {

            // Filtrar posts por contenido o por nombre del usuario
            $postsQuery->where(function ($q) use ($texto) {
                $q->where('content', 'LIKE', "%{$texto}%")
                  ->orWhereHas('user', function ($u) use ($texto) {
                      $u->where('name', 'LIKE', "%{$texto}%");
                  });
            });

            // Buscar usuarios por nombre o email
            $users = User::where(function ($q) use ($texto) {
                    $q->where('name', 'LIKE', "%{$texto}%")
                      ->orWhere('email', 'LIKE', "%{$texto}%");
                })
                ->orderBy('id', 'desc')
                ->get();
        }

        // Paginamos los posts (filtrados o no)
        $posts = $postsQuery->paginate(10);

        return view('home.home.inicio', [
            'posts' => $posts,
            'users' => $users,
            'texto' => $texto,
        ]);
    }
}
