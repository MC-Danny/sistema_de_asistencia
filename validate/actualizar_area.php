<?php
if (!empty($_POST["codigo"]) and !empty($_POST["area"]) and !empty($_POST["telefono"]) 
and !empty($_POST["ubicacion"]) and !empty($_POST["empresa"])) {
    include "../conexion.php";
    $code=$_POST["codigo"];
    $area = $_POST["area"];
    $tel=$_POST['telefono'];
    $ubi = $_POST["ubicacion"];
    $emp=$_POST['empresa'];
        // Insertar el nuevo usuario
    $sql_insert = "UPDATE tblarea SET NOM_AREA=?,TEL_AREA=?, UBI_AREA=?, COD_EMP=? WHERE COD_AREA=?";
    $stmt_insert = $cn->prepare($sql_insert);
    $resultado = $stmt_insert->execute([ $area,$tel,$ubi,$emp,$code]);

    if ($resultado == true) {
        session_start();
        $_SESSION['aguardado'] = "Usuario creado correctamente";
        header("location:../vista/area.php");
    } else {
        session_start();
        $_SESSION['aerror'] = "Hubo un error al crear el usuario";
        header("location:../vista/area.php");
    }
    
     
}else {
        // Manejo de campos vacíos
        session_start();
        $_SESSION['avacio'] = "Por favor, complete todos los campos";
        header("location:../vista/area.php");
}
?>