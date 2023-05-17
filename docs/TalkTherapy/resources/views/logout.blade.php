<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar sesión</title>
</head>
<body>
    <h1>Cerrar sesión</h1>
    <p>¿Está seguro que desea cerrar sesión?</p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Sí, cerrar sesión</button>
    </form>
</body>
</html>
