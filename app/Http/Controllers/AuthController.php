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
                return back()->with('error', 'Su cuenta está inactiva. Contacte con el administrador.');
            }

            // Redirección según rol
            if ($user->hasRole('admin')) {
                return redirect()->route('dashboard');
            }

            if ($user->hasRole(roles: 'cliente') || $user->hasRole('freelancer')) {
                return redirect()->route('inicio');
            }

            // Si no tiene roles conocidos, mándalo al home genérico
            return redirect()->route('web.index');
        }

        return back()
            ->with('error', 'Las credenciales no son correctas.')
            ->withInput();
    }
}
