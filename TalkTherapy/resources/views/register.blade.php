<form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" required>
    </div>
    <div>
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos" required>
    </div>
    <div>
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" id="direccion" required>
    </div>
    <div>
        <label for="ciudad">Ciudad</label>
        <input type="text" name="ciudad" id="ciudad" required>
    </div>
    <div>
        <label for="codigo_postal">Código postal</label>
        <input type="text" name="codigo_postal" id="codigo_postal" required>
    </div>
    <div>
        <label for="fecha_nacimiento">Fecha de nacimiento</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>
    </div>
    <div>
        <label for="telefono">Teléfono</label>
        <input type="tel" name="telefono" id="telefono" required>
    </div>
    <div>
        <label for="numero_colegiado">Nombre de usuario</label>
        <input type="text" name="nombre_usuario" id="nombre_usuario" required>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
    </div>
    <div>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" required>
    </div>
    <div>
        <label for="password_confirmation">Confirmar contraseña</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
    </div>
    <div>
        <label for="foto_selfie">Foto de selfie</label>
        <input type="file" name="foto_selfie" id="foto_selfie" accept="image/*" required>
    </div>

    <div>
        <label for="dni_anverso">Foto del anverso del DNI</label>
        <input type="file" name="foto_dni_anverso" id="foto_dni_anverso" accept="image/*" required>
    </div>
    <div>
        <label for="dni_reverso">Foto del reverso del DNI</label>
        <input type="file" name="foto_dni_reverso" id="foto_dni_reverso" accept="image/*" required>
    </div>
    <button type="submit">Registrarse</button>
</form>
