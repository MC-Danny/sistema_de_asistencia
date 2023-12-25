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
    $cargo = $_POST["cargo"];

        // Verificar si el usuario ya existe
    $sql_check = "SELECT * FROM tblempleado WHERE dni =?";
    $stmt_check = $cn->prepare($sql_check);
    $stmt_check->execute([$dni]);
    $existe = $stmt_check->fetch();

    if ($existe) {
        session_start();
        $_SESSION['emexiste'] = "El usuario ya existe";
        header("location:../vista/empleado.php");
    } else {
            // Insertar el nuevo usuario
        $sql_insert = "INSERT INTO tblempleado (dni,nombres, apellidos,celular,correo,cod_area,cod_cargo) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $cn->prepare($sql_insert);
        $resultado = $stmt_insert->execute([$dni, $nombres, $apellidos,$celular, $correo, $area,$cargo]);

        if ($resultado == true) {
            session_start();
            $_SESSION['emalerta'] = "Usuario creado correctamente";
            header("location:../vista/empleado.php");
        } else {
            session_start();
            $_SESSION['emerror'] = "Hubo un error al crear el usuario";
            header("location:../vista/empleado.php");
        }
    }
     
}else {
        // Manejo de campos vacíos
        session_start();
        $_SESSION['emvacio'] = "Por favor, complete todos los campos";
        header("location:../vista/empleado.php");
}
?>