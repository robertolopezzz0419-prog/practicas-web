
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de administrador</title>

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>

    <main class="contenedor">

        <section class="tarjeta">

            <h1>Verifica tu identidad </h1>

            <p class="subtitulo">
                Ingresa el codigo que enviamos a tu correo electronico.
            </p>

            @if (session('success'))
                <p class="mensaje-exito">{{ session('success') }}</p>
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="error">{{ $error }}</p>
                @endforeach
            @endif

            <h2 class="titulo-tiempo">Tiempo restante</h2>

            @if (session('codigo_expira'))
                <div class="temporizador">
                    <span id="tiempo">05:00</span>
                </div>
                <p id="estado-tiempo" class="texto-tiempo">
                    Tu codigo tiene una duracion de 5 minutos.
                </p>
            @else
                <p class="texto-tiempo">
                    Primero solicita tu codigo de verificacion.
                </p>
            @endif

            <form action="{{ route('verificacion.enviar') }}" method="POST">
                @csrf
                <button type="submit">Enviar codigo al correo</button>
            </form>

            <hr>

            <h2 class="titulo-tiempo">Codigo de verificacion</h2>

            <form action="{{ route('verificacion.comprobar') }}" method="POST">
                @csrf

                <label for="codigo">Codigo de 6 digitos</label>

                <input
                    type="text"
                    id="codigo"
                    name="codigo"
                    maxlength="6"
                    inputmode="numeric"
                    placeholder="Escribe tu codigo"
                    required
                >

                <button type="submit">Verificar codigo</button>
            </form>

        </section>

    </main>

    @if (session('codigo_expira'))
        <script>
            const reloj = document.getElementById('tiempo');
            const estado = document.getElementById('estado-tiempo');

           const fechaExpiracion = {{ \Illuminate\Support\Carbon::parse(session('codigo_expira'))->timestamp }} * 1000;
            function actualizarTemporizador() {
                const ahora = Date.now();
                const diferencia = Math.max(0, Math.floor((fechaExpiracion - ahora) / 1000));

                const minutos = Math.floor(diferencia / 60);
                const segundos = diferencia % 60;

                reloj.textContent =
                    String(minutos).padStart(2, '0') + ':' +
                    String(segundos).padStart(2, '0');

                if (diferencia <= 0) {
                    estado.textContent = 'El código ha vencido. Solicita uno nuevo.';
                }
            }

            actualizarTemporizador();
            setInterval(actualizarTemporizador, 1000);
        </script>
    @endif

</body>
</html>
