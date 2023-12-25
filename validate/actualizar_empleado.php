<?php
if (!empty($_POST["dni"]) and !empty($_POST["nombre"]) and !empty($_POST["apellido"]) and !empty($_POST["celular"]) 
and !empty($_POST["correo"]) and !empty($_POST["area"]) and !empty($_POST["cargo"]) ) {
    include "../conexion.php";
    $dni = $_POST["dni"];
    $nombres = $_POST["nombre"];
    $apellidos = $_POST["apellido"];
    $celular =$_POST["celular"];
    $correo = $_POST["correo"];
    $area = $_POST["area"];
    $cargo = $_POST["cargo"];       // Insertar el nuevo usuario
    $sql_insert = "UPDATE tblempleado SET NOMBRES=?,APELLIDOS=?, CELULAR=?, CORREO=?, COD_AREA=?, COD_CARGO=? WHERE DNI= ?";
    $stmt_insert = $cn->prepare($sql_insert);
    $resultado = $stmt_insert->execute([$nombres, $apellidos,$celular, $correo, $area,$cargo,$dni]);

    if ($resultado == true) {
        session_start();
        $_SESSION['eguardado'] = "Usuario creado correctamente";
        header("location:../vista/empleado.php");
    } else {
        session_start();
        $_SESSION['eerror'] = "Hubo un error al crear el usuario";
        header("location:../vista/empleado.php");
    }
    
     
}else {
        // Manejo de campos vacíos
        session_start();
        $_SESSION['evacio'] = "Por favor, complete todos los campos";
        header("location:../vista/empleado.php");
}
?>