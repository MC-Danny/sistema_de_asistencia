<?php
if (!empty($_POST["codigo"]) and !empty($_POST["cargo"]) ) {
    include "../conexion.php";
    $codigo = $_POST['codigo'];
        $cargo = $_POST['cargo'];

        // Verificar si el usuario ya existe
    $sql_check = "SELECT * FROM tblcargo WHERE COD_CARGO =? ";
    $stmt_check = $cn->prepare($sql_check);
    $stmt_check->execute([$codigo]);
    $existe = $stmt_check->fetch();

    if ($existe) {
        session_start();
        $_SESSION['cexiste'] = "El usuario ya existe";
        header("location:../vista/cargo.php");
    } else {
            $sql = "INSERT INTO TBLCARGO (COD_CARGO, NOM_CARGO) VALUES (?, ?)";
            $sentencia = $cn->prepare($sql);
            $resultado = $sentencia->execute([$codigo, $cargo]);

        if ($resultado == true) {
            session_start();
            $_SESSION['calerta'] = "Usuario creado correctamente";
            header("location:../vista/cargo.php");
        } else {
            session_start();
            $_SESSION['cerror'] = "Hubo un error al crear el usuario";
            header("location:../vista/cargo.php");
        }
    }
     
}else {
        // Manejo de campos vacíos
        session_start();
        $_SESSION['cvacio'] = "Por favor, complete todos los campos";
        header("location:../vista/cargo.php");
}
?>

