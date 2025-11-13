<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credenciales = $request->only('email', 'password');

        if (Auth::attempt($credenciales)) {
            $user = Auth::user();

            if (!$user->activo) {
                Auth::logout();
                return back()->with('error', 'Su cuenta está inactiva. Contacte con el administrador');
            }

            // Redirigir según rol
            if ($user->hasRole('cliente')) {
                return redirect()->route('inicio');
            } elseif ($user->hasRole('admin')) {
                return redirect()->route('dashboard');
            }

            // Si no tiene rol definido
            Auth::logout();
            return back()->with('error', 'No tiene rol asignado. Contacte con el administrador');

        }

        return back()->with('error', 'Las credenciales no son correctas')->withInput();
    }
}
