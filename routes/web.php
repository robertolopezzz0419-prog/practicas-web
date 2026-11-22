<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerificacionController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'autenticar'])
    ->name('login.autenticar');
    

Route::middleware(['auth'])->group(function () {

    // Rutas del administrador
    Route::middleware(['rol:administrador'])->group(function () {

        Route::get('/verificacion', function () {
            return view('auth.verificacion');
        })->name('verificacion.form');

        Route::post('/verificacion/enviar', [VerificacionController::class, 'enviarCodigo'])
            ->name('verificacion.enviar');

        Route::post('/verificacion/comprobar', [VerificacionController::class, 'comprobarCodigo'])
            ->name('verificacion.comprobar');

        Route::get('/administrador/inicio', function () {
            return view('administrador.inicio');
        })->name('administrador.inicio');

    });

    // Rutas del empleado
    Route::middleware(['rol:empleado'])->group(function () {

        Route::get('/empleado/inicio', function () {
            return view('empleado.inicio');
        })->name('empleado.inicio');

    });
    
    Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

});
