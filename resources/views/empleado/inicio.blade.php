<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio empleado</title>

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>
    <main class="contenedor">

        <section class="tarjeta">

            <h1>¡Bienvenido, empleado! </h1>

            <p class="subtitulo">
                Has iniciado sesion.
            </p>

            
            <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Cerrar sesión</button>
</form>
        </section>

    </main>

</body>
</html>