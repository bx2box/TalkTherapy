<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- Agregar enlace al archivo de Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css"
     integrity="sha512-DVUY2Lwmp4tZu4t4YXcI/8tA1fcx59fjyBoLmzxbH8mLcJZitQ2zdK9CtwvDqT3N6OV25AmJaLx3PTq3iUrE3g=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Estilos para el encabezado */
        h1 {
          font-size: 2em;
          font-weight: bold;
          margin: 1em 0;
        }

        /* Estilos para la navegación */
        nav ul {
          list-style-type: none;
          margin: 0;
          padding: 0;
          overflow: hidden;
          background-color: #f1f1f1;
        }

        nav li {
          float: left;
        }

        nav li a {
          display: block;
          color: #333;
          text-align: center;
          padding: 14px 16px;
          text-decoration: none;
        }

        nav li a:hover {
          background-color: #ddd;
        }

        /* Estilos para la tabla de psicólogos */
        table.psicologo {
          width: 100%;
          border-collapse: collapse;
          margin-top: 2em;
        }

        table.psicologo td {
          border: 1px solid #ddd;
          padding: 8px;
        }

        table.psicologo tr:nth-child(even) {
          background-color: #f2f2f2;
        }

        table.psicologo tr:hover {
          background-color: #ddd;
        }

        table.psicologo img {
          max-width: 150px;
        }

        table.psicologo h3 {
          margin-top: 0;
        }

        table.psicologo p {
          margin-bottom: 0.5em;
        }

        /* Estilos para el botón "Reservar cita" */
        button.btn.btn-primary {
          margin-top: 1em;
        }

        /* Estilos para el formulario de reserva de citas */
        body {font-family: Arial, Helvetica, sans-serif;}

        /* Fondo modal: negro con opacidad al 50% */
        .modal {
        display: none; /* Por defecto, estará oculto */
        position: fixed; /* Posición fija */
        z-index: 1; /* Se situará por encima de otros elementos de la página*/
        padding-top: 200px; /* El contenido estará situado a 200px de la parte superior */
        left: 0;
        top: 0;
        width: 100%; /* Ancho completo */
        height: 100%; /* Algura completa */
        overflow: auto; /* Se activará el scroll si es necesario */
        background-color: rgba(0,0,0,0.5); /* Color negro con opacidad del 50% */
        }

        /* Ventana o caja modal */
        .modal-content {
        position: relative; /* Relativo con respecto al contenedor -modal- */
        background-color: white;
        margin: auto; /* Centrada */
        padding: 20px;
        width: 60%;
        -webkit-animation-name: animarsuperior;
        -webkit-animation-duration: 0.5s;
        animation-name: animarsuperior;
        animation-duration: 0.5s
        }

        /* Animación */
        @-webkit-keyframes animatetop {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
        }

        @keyframes animarsuperior {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
        }

        /* Botón cerrar */
        .close {
        color: black;
        float: right;
        font-size: 30px;
        font-weight: bold;
        }

        .close:hover,
        .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
        }
      </style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Hola, {{ Auth::user()->nombre }} ¿Cómo te encuentras hoy?</h1>
        <nav>
            <ul>
                <li><a href="{{ route('usuario.index') }}">Psicólogos</a></li>
                <li><a href="{{ route('usuario.Vistacitas') }}">Citas</a></li>
                <li><a href="{{ route('usuario.index', Auth::user()->id) }}">Datos personales</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link">Cerrar sesión</button>
                    </form>
                </li>
            </ul>
        </nav>
        <h2>Psicólogos</h2>
        @if (!empty($psicologos) && count($psicologos) > 0)
            @foreach($psicologos as $psicologo)
                <table class="psicologo">
                    <tr>
                        <td>
                            <img src="{{ $psicologo->foto_selfie }}" alt="">
                            <h3>{{ $psicologo->nombre }} {{ $psicologo->apellidos }}</h3>
                            <p>Numero de colegiado: <b>{{ $psicologo->num_colegiado }}</b></p>
                            <p>Precio 30 minutos: {{ $psicologo->precio_sesion }}€</p>
                            <button id="abrirModal{{ $psicologo->id }}">Reservar cita</button>
                        </td>
                    </tr>
                </table>
                <br>
                <div class="modal" id="ventanaModal{{ $psicologo->id }}">
                    <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reservarCita{{ $psicologo->id }}Label">Reservar cita con {{ $psicologo->nombre }} {{ $psicologo->apellidos }}</h5>
                                <span class="cerrar">&times;</span>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('usuario.citas') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="psicologo_id" value="{{ $psicologo->id }}">
                                    <div class="form-group">
                                        <label for="fecha">Fecha</label>
                                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="hora">Hora</label>
                                        <input type="time" class="form-control" id="hora" name="hora" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="duracion">Duración (minutos)</label>
                                        <select class="form-control" id="duracion" name="duracion" required>
                                            <option value="30">30</option>
                                            <option value="60">60</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Reservar</button>
                                </form>
                            </div>
                        </div>
                    </div>

                  <script>
                    // Ventana modal
                    var modal{{ $psicologo->id }} = document.getElementById("ventanaModal{{ $psicologo->id }}");

                    // Botón que abre el modal
                    var boton{{ $psicologo->id }} = document.getElementById("abrirModal{{ $psicologo->id }}");

                    // Hace referencia al elemento <span> que tiene la X que cierra la ventana
                    var span{{ $psicologo->id }} = document.getElementsByClassName("cerrar")[{{ $loop->index }}];

                    // Cuando el usuario hace click en el botón, se abre la ventana
                    boton{{ $psicologo->id }}.addEventListener("click",function() {
                        modal{{ $psicologo->id }}.style.display = "block";
                    });

                    // Si el usuario hace click en la x, la ventana se cierra
                    span{{ $psicologo->id }}.addEventListener("click",function() {
                        modal{{ $psicologo->id }}.style.display = "none";
                    });

                    // Si el usuario hace click fuera de la ventana, se cierra.
                    window.addEventListener("click",function(event) {
                        if (event.target == modal{{ $psicologo->id }}) {
                            modal{{ $psicologo->id }}.style.display = "none";
                        }
                    });
              </script>
            @endforeach
        @else
            <p>No hay psicólogos disponibles en este momento.</p>
        @endif
    </div>
</body>
</html>
