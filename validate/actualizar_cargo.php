<?php
if (!empty($_POST["codigo"]) and !empty($_POST["cargo"])) {
    include "../conexion.php";
    $code=$_POST["codigo"];
    $cargo = $_POST["cargo"];
       // Insertar el nuevo usuario
    $sql_insert = "UPDATE tblcargo SET NOM_CARGO=? WHERE COD_CARGO=?";
    $stmt_insert = $cn->prepare($sql_insert);
    $resultado = $stmt_insert->execute([$cargo,$code]);

    if ($resultado == true) {
        session_start();
        $_SESSION['cguardado'] = "Usuario creado correctamente";
        header("location:../vista/cargo.php");
    } else {
        session_start();
        $_SESSION['cerror'] = "Hubo un error al crear el usuario";
        header("location:../vista/cargo.php");
    }
    
     
}else {
        // Manejo de campos vacíos
        session_start();
        $_SESSION['cvacio'] = "Por favor, complete todos los campos";
        header("location:../vista/cargo.php");
}
?>