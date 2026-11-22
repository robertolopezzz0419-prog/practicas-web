
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de administrador</title>

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>

    <main class="contenedor">

        <section class="tarjeta">

            <h1>¡Bienvenido, administrador! </h1>

            <p class="subtitulo">
                Has iniciado sesión y verificado tu correo correctamente.
            </p>

            <div class="mensaje-exito">
                <p>Tu acceso ha sido autorizado.</p>
            </div>
        
            <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Cerrar sesión</button>
</form>
        </section>

    </main>

</body>
</html>
