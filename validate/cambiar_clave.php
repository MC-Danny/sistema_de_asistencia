<?php
    if (!empty($_POST["contraactual"]) and !empty($_POST["contranueva"]) 
    and !empty($_POST["repetircontra"]) and !empty($_POST["codigo"])) {
        include "../conexion.php";
        $actual = md5($_POST["contraactual"]);
        $nueva = md5($_POST["contranueva"]);
        $repetir = md5($_POST["repetircontra"]);
        $id=$_POST["codigo"];

        // Verificar si la contraseña existe
        $sql_check = "SELECT * FROM tblusuario WHERE CONTRA=? AND COD_USER =?";
        $stmt_check = $cn->prepare($sql_check);
        $stmt_check->execute([$actual,$id]);
        $existe = $stmt_check->fetch();
    
        if ($existe) {
            if($nueva==$repetir){
                $sql_insert = "UPDATE tblusuario SET CONTRA=? WHERE COD_USER=?";
                $stmt_insert = $cn->prepare($sql_insert);
                $resultado = $stmt_insert->execute([$nueva,$id]);
                if($resultado==true){
                    session_start();
                    $_SESSION['cambiar'] = "Contraseña actualizada correctamente";
                    header("location:../vista/inicio.php");
                    exit;
                }else{
                    session_start();
                    $_SESSION['nose'] = "Hubo un error al actualizar la contraseña";
                    header("location:../vista/inicio.php");
                    exit;
                }
                
            }else {
                session_start();
                $_SESSION['error'] = "Las contraseñas no coinciden";
                header("location:../vista/usuario.php");
                exit;
            }
            
        } else {
            session_start();
            $_SESSION['no'] = "La contraseña actual es incorrecta";
            header("location:../vista/inicio.php");
            exit;
        }
         
    } else {
        // Manejo de campos vacíos
        session_start();
        $_SESSION['vacio'] = "Por favor, complete todos los campos";
        header("location:../vista/inicio.php");
        exit;
    }
?>



