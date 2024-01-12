<?php
if (!empty($_POST["usuario"]) and !empty($_POST["usuario"]) and !empty($_POST["nombre"]) and !empty($_POST["apellido"])) {
    include "../conexion.php";
    $code=$_POST["codigo"];
    $usuario = $_POST["usuario"];
    $estado = $_POST["estado"];
    $nombres = $_POST["nombre"];
    $apellidos = $_POST["apellido"];        // Insertar el nuevo usuario
    $sql_insert = "UPDATE tblusuario SET nom_user=?, estado=?, nombres=?, apellidos=? WHERE COD_USER=?";
    $stmt_insert = $cn->prepare($sql_insert);
    $resultado = $stmt_insert->execute([$usuario, $estado, $nombres, $apellidos,$code]);

    if ($resultado == true) {
        session_start();
        $_SESSION['uguardado'] = "Usuario creado correctamente";
        header("location:../vista/usuario.php");
    } else {
        session_start();
        $_SESSION['uerror'] = "Hubo un error al crear el usuario";
        header("location:../vista/usuario.php");
        }
    
     
}else {
        // Manejo de campos vacíos
        session_start();
        $_SESSION['uvacio'] = "Por favor, complete todos los campos";
        header("location:../vista/usuario.php");
}
?>