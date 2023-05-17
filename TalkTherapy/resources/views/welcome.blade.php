<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TalkTherapy</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #fff;
            box-shadow: 0px 1px 3px rgba(0,0,0,0.12), 0px 1px 2px rgba(0,0,0,0.24);
            padding: 20px;
            text-align: center;
        }
        h1 {
            font-size: 36px;
            margin-bottom: 0;
        }
        p {
            font-size: 18px;
            margin-top: 10px;
        }
        .hero-image {
            background-image: url("");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 600px;
        }
        .hero-text {
            color: #fff;
            padding: 200px 0;
            text-align: center;
        }
        .btn {
            background-color: #5b8ce5;
            border-radius: 5px;
            color: #fff;
            display: inline-block;
            font-size: 20px;
            margin-top: 20px;
            padding: 10px 20px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #4c7bd9;
        }
    </style>
</head>
<body>
    <header>
        <h1>TalkTherapy</h1>
        <p>La plataforma para conectarte con terapeutas de confianza</p>
    </header>
    <div class="hero-image">
        <div class="hero-text">
            <h2>Empieza tu camino hacia una vida más saludable hoy mismo</h2>
            <a href="{{ route('register') }}" class="btn">Regístrate ahora</a>
            <a href="{{ route('login') }}" class="btn">Iniciar sesión</a><br>
            <h2>Empieza a ayudar a personas a lograr sus objetivos</h2>
            <a href="{{ route('registerP') }}" class="btn">Regístrate como Psicologo</a>
            <a href="{{ route('loginP') }}" class="btn">Iniciar sesión como Psicologo</a>
        </div>
    </div>
</body>
</html>
