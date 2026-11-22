<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de administrador</title>
</head>
<body>

    <h1>Verificación de administrador</h1>

    <p>Para continuar, verifica tu identidad con el código enviado a tu correo.</p>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif

    <h2>1. Solicitar código</h2>

    <form action="{{ route('verificacion.enviar') }}" method="POST">
        @csrf
        <button type="submit">Enviar código al correo</button>
    </form>

    <h2>2. Ingresar código</h2>

    <form action="{{ route('verificacion.comprobar') }}" method="POST">
        @csrf

        <label for="codigo">Código de 6 dígitos:</label>
        <input
            type="text"
            id="codigo"
            name="codigo"
            maxlength="6"
            inputmode="numeric"
            required
        >

        <button type="submit">Verificar código</button>
    </form>

</body>
</html>