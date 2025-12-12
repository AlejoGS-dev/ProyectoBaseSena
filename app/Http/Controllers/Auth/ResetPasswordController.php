<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    public function showRequestForm()
    {
        return view('autenticacion.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => Carbon::now()
            ]
        );

        // Construir URL completa
        $resetUrl = url('/password/reset/' . $token . '?email=' . urlencode($request->email));

        Mail::send('emails.reset-password', [
    'url' => $resetUrl
], function ($message) use ($request) {
    $message->to($request->email)
            ->subject('Recuperación de contraseña - Sistema');
});

return back()->with('mensaje', 'Te enviamos un enlace a tu correo.');

    }

    public function showResetForm(Request $request, $token)
    {
        return view('autenticacion.reset', [
            'token' => $token,
            'email' => $request->query('email')
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ]);

        $passwordReset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$passwordReset) {
            return back()->withErrors(['email' => 'Token inválido o expirado.']);
        }

        if (!Hash::check($request->token, $passwordReset->token)) {
            return back()->withErrors(['email' => 'Token inválido o expirado.']);
        }

        if (Carbon::parse($passwordReset->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'El enlace expiró.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('mensaje', 'Tu contraseña fue cambiada.');
    }
}
