<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Call</title>
    <!-- Agrega las etiquetas <script> y <link> necesarias para PeerJS -->
    <script src="https://unpkg.com/peerjs@1.4.7/dist/peerjs.min.js"></script>

    <!-- Agrega otros scripts y estilos necesarios -->
</head>
<body>
    <!-- Contenido de la página de videollamada -->
    <h1>Video Call</h1>
    
    <div>
        <video id="localVideo" autoplay></video>
        <video id="remoteVideo" autoplay></video>
    </div>

    <!-- Agrega la lógica de la videollamada -->
    <script>
        // Configuración de PeerJS
        const peer = new Peer();

        // Obtén el ID del usuario actual y el ID del psicólogo de la URL
        const urlParams = new URLSearchParams(window.location.search);
        const userId = urlParams.get('id_usuario');
        const psicologoId = urlParams.get('id_psicologo');

        // Variables para almacenar los flujos de video local y remoto
        let localStream;
        let remoteStream;

        // Función para iniciar la videollamada
        function startCall() {
            navigator.mediaDevices.getUserMedia({ video: true, audio: true })
                .then((stream) => {
                    localStream = stream;
                    document.getElementById('localVideo').srcObject = localStream;

                    const call = peer.call(psicologoId, stream);
                    call.on('stream', (remoteStream) => {
                        remoteStream.addEventListener('addtrack', () => {
                            document.getElementById('remoteVideo').srcObject = remoteStream;
                        });
                    });
                })
                .catch((error) => {
                    console.error('Error al obtener el flujo de video:', error);
                });
        }

        // Manejo de eventos de PeerJS
        peer.on('call', (call) => {
            navigator.mediaDevices.getUserMedia({ video: true, audio: true })
                .then((stream) => {
                    localStream = stream;
                    document.getElementById('localVideo').srcObject = localStream;

                    call.answer(localStream);
                    call.on('stream', (remoteStream) => {
                        remoteStream.addEventListener('addtrack', () => {
                            document.getElementById('remoteVideo').srcObject = remoteStream;
                        });
                    });
                })
                .catch((error) => {
                    console.error('Error al obtener el flujo de video:', error);
                });
        });

        // Llama a la función startCall() cuando se cargue la página
        startCall();
    </script>
</body>
</html>
