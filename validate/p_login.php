<?php
session_start();
if (!empty($_POST['btningresar'])) {
    if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
        include "../conexion.php";
        $usuario = $_POST['usuario'];
        $pass = md5($_POST['password']);

        // Using prepared statements to prevent SQL injection
        $sql = "SELECT * FROM TBLUSUARIO WHERE NOM_USER=? AND CONTRA=? AND estado='1'";
        $sentencia = $cn->prepare($sql);
        $sentencia->execute([$usuario, $pass]);
        $user = $sentencia->fetch(PDO::FETCH_OBJ);

        // Check if the user exists
        if ($user) {
            $_SESSION['id'] = $user->COD_USER;
            $_SESSION['nombre'] = $user->NOMBRES;
            $_SESSION['apellido'] = $user->APELLIDOS;
            header("location: ../vista/inicio.php");
            exit; // Ensure to terminate script after redirection
        } else {
            // Invalid username or password
            $_SESSION['alerta'] = 'Usuario o contraseña incorrectos';
            header("location:../vista/login/login.php");
            exit; // Exit script after setting alert
        }
    } else {
        $_SESSION['alerta'] = 'Por favor, complete todos los campos';
        header("location:../vista/login/login.php");
        exit; // Exit script after setting alert
    }
}
?>





