<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GeneradorCodigo;
use App\Notifications\CodigoVerificacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class VerificacionController extends Controller
{
    public function enviarCodigo(GeneradorCodigo $generador)
    {
        $usuario = Auth::user();

        $codigo = $generador->generar();

        Session::put('codigo_verificacion', Hash::make($codigo));
        Session::put('codigo_expira', now()->addMinutes(5));
        Session::put('intentos_codigo', 0);

        $usuario->notify(new CodigoVerificacion($codigo));

        return back()->with('success', 'Se envió un código a tu correo.');
    }

    public function comprobarCodigo(Request $request)
    {
        $request->validate([
            'codigo' => 'required|digits:6'
        ]);

        $codigoGuardado = Session::get('codigo_verificacion');
        $expiracion = Session::get('codigo_expira');

        if (!$codigoGuardado || !$expiracion || now()->greaterThan($expiracion)) {
            return back()->withErrors([
                'codigo' => 'El código venció. Solicita uno nuevo.'
            ]);
        }

        $intentos = Session::get('intentos_codigo', 0);

        if ($intentos >= 5) {
            Session::forget([
                'codigo_verificacion',
                'codigo_expira',
                'intentos_codigo'
            ]);

            return back()->withErrors([
                'codigo' => 'Superaste los 5 intentos. Solicita un nuevo código.'
            ]);
        }

        if (!Hash::check($request->codigo, $codigoGuardado)) {

    $intentos++;

    Session::put('intentos_codigo', $intentos);

    if ($intentos >= 5) {

        Session::forget([
            'codigo_verificacion',
            'codigo_expira',
            'intentos_codigo'
        ]);

        return back()->withErrors([
            'codigo' => 'Superaste los 5 intentos. Solicita un nuevo código.'
        ]);
    }

    return back()->withErrors([
        'codigo' => 'El código ingresado es incorrecto. Intentos restantes: ' . (5 - $intentos)
    ]);
}
        Session::forget([
            'codigo_verificacion',
            'codigo_expira',
            'requiere_verificacion',
            'intentos_codigo'
        ]);

        Session::put('administrador_verificado', true);

        return redirect()->route('administrador.inicio');
    }
}
