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

<link href="public/pnotify/css/pnotify.css" rel="stylesheet" />
<link href="public/pnotify/css/pnotify.buttons.css" rel="stylesheet" />
<link href="public/pnotify/css/custom.min.css" rel="stylesheet" />
  <!-- pnotify -->
<script src="public/pnotify/js/jquery.min.js">
</script>
<script src="public/pnotify/js/pnotify.js">
</script>
<script src="public/pnotify/js/pnotify.buttons.js">
        </script>
</head>
<body>
    <?php  
        date_default_timezone_set('America/Lima'); 
    ?>
    <h1>BIENVENIDOS, REGISTRA TU ASISTENCIA</h1>
    <h2 id="fecha"><?=date('d/m/Y, H:i:s')?></h2>
    <?php
    include "conexion.php";
    include "validate/registrar_entrada.php";
    include "validate/registrar_salida.php";
    ?>
    <div class="container">
        <a href="vista/login/login.php" class="acceso">Ingresar al sistema</a>
        <p class="dni">Ingresa tu DNI</p>
        <form action="" method="POST">
            <input type="number" placeholder="DNI del empleado" id="dni" name="txtdni">
            <div class="botones">
                <button id="salida" type="submit" value="ok" class="salida" name="btnsalida">SALIDA</button>
                <button id="entrada" type="submit" value="ok" class="entrada" name="btnentrada">ENTRADA</button>
            
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
    <script>
        let dni=document.getElementById("dni");
        dni.addEventListener("input", function(){
            if(this.value.length>8){
                this.value=this.value.slice(0,8)
            }
        })

        document.addEventListener("keyup",function(event){
            if(event.code=="ArrowLeft"){
                document.getElementById("salida").click()
            }else{
                if(event.code=="ArrowRight"){
                    document.getElementById("entrada").click()
                }
            }
        })
    </script>
</body>
</html>