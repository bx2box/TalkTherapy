<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">{{ __('Mis citas') }}</div>

                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Fecha y hora</th>
                                            <th scope="col">Usuario</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($citas as $cita)
                                            <tr>
                                                <th scope="row">{{ $cita->id }}</th>
                                                <td>{{ $cita->fecha_cita }}</td>
                                                <td>{{ $cita->usuario->nombre_usuario }}</td>
                                                <td>
                                                    <!-- Botón para que el psicólogo se una a la videollamada -->
                                                    <button onclick="joinCall('psicologo')">Unirse a la videollamada</button>

                                                    <!-- Agrega las etiquetas <script> y <link> necesarias para PeerJS -->
                                                    <!-- Agrega las etiquetas <script> y <link> necesarias para PeerJS -->
                                                    <script src="https://unpkg.com/peerjs@1.4.7/dist/peerjs.min.js"></script>
                                                    <script>
                                                        function joinCall(role) {
                                                            // Obtiene el ID del usuario desde el elemento de datos en la fila de la tabla
                                                            const usuarioId = event.target.parentNode.parentNode.dataset.usuarioId;

                                                            // Redirige a la página de videollamada con el ID del usuario y el rol como parámetros
                                                            window.location.href = '/videocall?role=' + role + '&usuarioId=' + usuarioId;
                                                        }
                                                    </script>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>
</html>