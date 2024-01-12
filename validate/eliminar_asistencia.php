<?php 

session_start();
if(!isset($_GET["id"])){
	exit();
}
	include "../conexion.php";
	$id=$_GET['id'];
	
	$consulta ="DELETE FROM tblasistencia WHERE COD_ASIS=?";
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
    header("Location:../vista/inicio.php");
}	
	else
		echo "error al guardar"

	

 ?>