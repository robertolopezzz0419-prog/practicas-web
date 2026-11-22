<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Inicio de sesion</title>

        <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    </head>
    <body>

        <main class="contenedor">
            <section class="tarjeta">
                <h1>Bienvenido </h1>
        <p class="subtitulo">Inicia sesión para continuar</p>
          <form action="{{ route('login.autenticar') }}" method="POST">
                @csrf

                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label for="email">Correo electrónico</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Ingresa tu correo"
                    required
                >

                <label for="password">Contraseña</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Ingresa tu contraseña"
                    required
                >

                <button type="submit">Iniciar sesión</button>

            </form>

            </section>
            </main>
        </body>
        </html>