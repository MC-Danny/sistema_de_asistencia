<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/estilos/estilos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Noto+Serif:ital,wght@1,300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@1,300&display=swap" rel="stylesheet">
    <title>REGISTRO DE ASISTENCIA</title>
</head>
<body>
    <h1>BIENVENIDOS, REGISTRA TU ASISTENCIA</h1>
    <h2 id="fecha"></h2>
    <div class="container">
        <a href="vista/login/login.php" class="acceso">Ingresar al sistema</a>
        <p class="dni">Ingresa tu DNI</p>
        <form action="">
            <input type="text" placeholder="DNI del empleado" name="textdni">
            <div class="botones">
            <a class="entrada" href="">ENTRADA</a>
            <a class="salida" href="">SALIDA</a>
            </div>
        </form>
    </div>



    <script>
        setInterval(() => {
            let fecha= new Date();
            let fechaHora= fecha.toLocaleString();
            document.getElementById("fecha").textContent = fechaHora;
        }, 1000);
    </script>
</body>
</html>