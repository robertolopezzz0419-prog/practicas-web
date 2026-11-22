<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function autenticar(Request $request)
    {
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credenciales)) {

            $request->session()->regenerate();

            $usuario = Auth::user();

            // Limpiar datos de verificaciones anteriores
            $request->session()->forget([
                'administrador_verificado',
                'requiere_verificacion',
                'codigo_verificacion',
                'codigo_expira',
                'intentos_codigo'
            ]);

            if ($usuario->rol === 'administrador') {

                $request->session()->put('requiere_verificacion', true);

                return redirect()->route('verificacion.form');
            }

            if ($usuario->rol === 'empleado') {
                return redirect()->route('empleado.inicio');
            }

            Auth::logout();

            return redirect()->route('login')
                ->withErrors([
                    'email' => 'El rol de usuario no es válido.'
                ]);
        }

        return back()->withErrors([
            'email' => 'El correo o la contraseña son incorrectos.'
        ])->onlyInput('email');
    }
}
