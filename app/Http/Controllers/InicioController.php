<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class InicioController extends Controller
{
    /**
     * Mostrar la página de inicio con posts paginados
     */
    public function index()
    {
        // Trae los 10 posts más recientes, con su usuario
        $posts = Post::with('user')->latest()->paginate(10);

        // Retorna la vista pasando los posts
        return view('home.home.inicio', compact('posts'));
    }
}
