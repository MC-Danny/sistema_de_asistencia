<?php
session_start();
if(empty($_SESSION['id'])){
	header("location: login/login.php");
}elseif(isset($_SESSION["id"])){
  include "../conexion.php";
  $consult="SELECT * from tblempresa WHERE COD_EMP='EMP001' ";	
  $resultado = $cn->query($consult); 
}
else{
  echo "Error al iniciar sesion";
}	
$empresa = $resultado->fetchAll(PDO::FETCH_OBJ);

?>
<style>
  ul li:nth-child(6) .activo{
    background: rgb(11, 150, 214) !important;
  }
</style>

<?php require('./layout/topbar.php'); ?>
<?php require('./layout/sidebar.php'); ?>

<?php
// session_start();
// if (empty($_SESSION['user']) and empty($_SESSION['clave'])) {
//     header('location:login/login.php');
// }

?>

<div class="page-content">

<?php
						foreach ($empresa as $dato) {

					?>
          <h1><?php echo $dato->NOM_EMP ?></h1>

          <H2><?php echo $dato->TELEFONO ?></H2>

          <h3><?php echo $dato->DIRECCION ?></h3>
          <h3><?php echo $dato->RUC ?></h3>
          <a href=""class="btn btn-success btn-rounded"  data-toggle="modal" data-target="#staticBackdrop1<?php echo $dato -> COD_EMP;  ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Editar</a>
          <div class="modal fade" id="staticBackdrop1<?php echo $dato -> COD_EMP;  ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header ">
                      <h5 class="modal-title text-center flex-grow-1" id="staticBackdropLabel">ACTUALIZAR USUARIO</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px;">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form class="row g-3 needs-validation"action="../validate/actualizar_usuario.php" method="POST" novalidate>
                    <div class="modal-body">
                      <div hidden class="col-md-3"><br>
                        <label for="validationCustom01" class="form-label">CODIGO</label>
                        <input  type="text" class="form-control" name="codigo"  value="<?php echo $dato -> COD_EMP; ?>" >
                      </div> 
                      <div class="col-md-6"><br>
                        <label for="validationCustom01" class="form-label">NOMBRE</label>
                        <input type="text" class="form-control" name="nombre"  value="<?php echo $dato -> NOM_EMP; ?>" >
                      </div>
                      <div class="col-md-6"><br>
                        <label for="validationCustom02" class="form-label">TELEFONO</label>
                        <input type="text" class="form-control" name="telefono" value="<?php echo $dato -> TELEFONO; ?>" >
                      </div>
                      <div class="col-md-6"><br>
                        <label for="validationCustom01" class="form-label">DIRECCION</label>
                        <input type="text" class="form-control" name="direccion" value="<?php echo $dato -> DIRECCION; ?>" >
                      </div>
                      <div class="col-md-6"><br>
                        <label for="validationCustom02" class="form-label">RUC</label>
                        <input type="text" class="form-control"name="ruc" value="<?php echo $dato -> RUC; ?>" >
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Volver</button>
                      <button type="submit" class="btn btn-primary btn-rounded">Actualizar</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
         
         
         <?php }

         ?>


</div>
</div>



<?php require('./layout/footer.php'); ?>