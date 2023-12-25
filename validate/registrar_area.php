<?php
if (!empty($_POST["codigo"]) and !empty($_POST["area"]) and !empty($_POST["telefono"])
and !empty($_POST["ubicacion"])and !empty($_POST["empresa"])) {
    include "../conexion.php";
    $codigo = $_POST["codigo"];
    $area = $_POST["area"];
    $tele = $_POST["telefono"];
    $ubi = $_POST["ubicacion"];
    $empre = $_POST["empresa"];

        // Verificar si el usuario ya existe
    $sql_check = "SELECT * FROM tblarea WHERE cod_area=? and nom_area =?";
    $stmt_check = $cn->prepare($sql_check);
    $stmt_check->execute([$codigo,$area]);
    $existe = $stmt_check->fetch();

    if ($existe) {
        session_start();
        $_SESSION['aexiste'] = "El usuario ya existe";
        header("location:../vista/area.php");
    } else {
            // Insertar el nuevo usuario
        $sql_insert = "INSERT INTO tblarea (cod_area, nom_area, tel_area, ubi_area, cod_emp) 
        VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = $cn->prepare($sql_insert);
        $resultado = $stmt_insert->execute([$codigo, $area, $tele, $ubi, $empre]);

        if ($resultado == true) {
            session_start();
            $_SESSION['aalerta'] = "Usuario creado correctamente";
            header("location:../vista/area.php");
        } else {
            session_start();
            $_SESSION['aerror'] = "Hubo un error al crear el usuario";
            header("location:../vista/area.php");
        }
    }
     
}else {
        // Manejo de campos vacíos
        session_start();
        $_SESSION['avacio'] = "Por favor, complete todos los campos";
        header("location:../vista/area.php");
}
?>