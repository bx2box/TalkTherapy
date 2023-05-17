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
                                            <th scope="col">Psicólogo</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($citas as $cita)
                                            <tr>
                                                <th scope="row">{{ $cita->id }}</th>
                                                <td>{{ $cita->fecha_cita }}</td>
                                                <td>{{ $cita->psicologo->nombre }}</td>
                                                <td>
                                                    <!-- Botón para que el usuario se una a la videollamada -->
                                                    <button onclick="joinCall('usuario')">Unirse a la videollamada</button>

                                                    <!-- Agrega las etiquetas <script> y <link> necesarias para PeerJS -->
                                                    <script src="https://unpkg.com/peerjs@1.4.7/dist/peerjs.min.js"></script>
<script>
    // Obtiene el ID del usuario y del psicólogo desde la URL
    const urlParams = new URLSearchParams(window.location.search);
    const psicologoId = urlParams.get('psicologoId');
    const role = urlParams.get('role');

    // Inicializa PeerJS y obtiene un ID de usuario aleatorio
    const peer = new Peer();
    let userId;
    peer.on('open', function(id) {
        userId = id;
    });

    // Conecta al usuario con el psicólogo
    const conn = peer.connect(psicologoId);
    conn.on('open', function() {
        // Envía el ID del usuario y el rol al psicólogo
        conn.send({ userId, role });
    });

    // Abre la conexión de video y audio
    navigator.mediaDevices.getUserMedia({ video: true, audio: true })
        .then(function(stream) {
            // Agrega el stream de video a la etiqueta de video
            const video = document.getElementById('video');
            video.srcObject = stream;
            video.play();

            // Inicia una llamada de video con el psicólogo
            const call = peer.call(psicologoId, stream);
            call.on('stream', function(remoteStream) {
                // Agrega el stream remoto a la etiqueta de video
                const remoteVideo = document.getElementById('remoteVideo');
                remoteVideo.srcObject = remoteStream;
                remoteVideo.play();
            });
        })
        .catch(function(err) {
            console.error('Error al obtener el stream de video y audio:', err);
        });
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
    