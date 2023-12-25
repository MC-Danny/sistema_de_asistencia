<?php 

session_start();
if(!isset($_GET["id"])){
	exit();
}
	include "../conexion.php";
	$id=$_GET['id'];
	
	$consulta ="DELETE FROM tblusuario WHERE COD_USER=?";
	$sql= $cn ->prepare($consulta);
	$resultado = $sql-> execute([$id]);
	if($resultado==true){?>
        <script>
            $(function notificacion(){
                new PNotify({
                    title: "CORRECTO",
                    type: "success",
                    text: "El usuario se ha eliminado correctamente",
                    styling: "bootstrap3"
                })
            })
        </script>
    <?php
    header("Location:../vista/usuario.php");
}	
	else
		echo "error al guardar"

	

 ?>