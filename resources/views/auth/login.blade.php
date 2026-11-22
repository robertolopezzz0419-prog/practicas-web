<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio de sesion</title>
</head>
<body>
    <h1>Iniciar sesion</h1>
    <form action="{{ route('login.autenticar') }}" method="POST">
        @csrf
        @error('email')
            <p>{{ $message }}</p>
        @enderror

        <label for="email">Correo electrónico</label>
       <input type="email" id="email" name="email" value="{{ old('email') }}" required>

        <br><br>

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>

        <br><br>

        <button type="submit">Ingresar</button>
    </form>
    
</body>
</html>