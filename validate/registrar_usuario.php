<?php
if (!empty($_POST["usuario"]) and !empty($_POST["contra"]) and !empty($_POST["nombre"]) and !empty($_POST["apellido"])) {
    include "../conexion.php";
    $usuario = $_POST["usuario"];
    $contraseña = md5($_POST["contra"]);
    $estado = $_POST["estado"];
    $nombres = $_POST["nombre"];
    $apellidos = $_POST["apellido"];

        // Verificar si el usuario ya existe
    $sql_check = "SELECT * FROM tblusuario WHERE nom_user =?";
    $stmt_check = $cn->prepare($sql_check);
    $stmt_check->execute([$usuario]);
    $existe = $stmt_check->fetch();

    if ($existe) {
        session_start();
        $_SESSION['existe'] = "El usuario ya existe";
        header("location:../vista/usuario.php");
    } else {
            // Insertar el nuevo usuario
        $sql_insert = "INSERT INTO tblusuario (nom_user, contra, estado, nombres, apellidos) 
        VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = $cn->prepare($sql_insert);
        $resultado = $stmt_insert->execute([$usuario, $contraseña, $estado, $nombres, $apellidos]);

        if ($resultado == true) {
            session_start();
            $_SESSION['alerta'] = "Usuario creado correctamente";
            header("location:../vista/usuario.php");
        } else {
            session_start();
            $_SESSION['error'] = "Hubo un error al crear el usuario";
            header("location:../vista/usuario.php");
        }
    }
     
}else {
        // Manejo de campos vacíos
        session_start();
        $_SESSION['vacio'] = "Por favor, complete todos los campos";
        header("location:../vista/usuario.php");
}
?>