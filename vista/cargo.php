<?php
session_start();
if(empty($_SESSION['id'])){
	header("location: login/login.php");
}elseif(isset($_SESSION["id"])){
  include "../conexion.php";
  $consulta="SELECT * from tblcargo";	
  $resultado = $cn->query($consulta); 
}
else{
  echo "Error al iniciar sesion";
}	
$cargo = $resultado->fetchAll(PDO::FETCH_OBJ);

?>
<style>
  ul li:nth-child(4) .activo{
    background: rgb(11, 150, 214) !important;
  }
</style>
<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">
  <h2 class="text-center">LISTA DE CARGOS</h2>

  <a href=""class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-plus" aria-hidden="true"></i>REGISTRAR</a>
<div style="overflow-x: auto;">
  <table class="table table-sm" id="example" style="width: 100%; max-width: 100%;">
    <!-- ... Tu contenido de la tabla ... -->
    <thead>
    <tr>
      <th scope="col">COD CARGO</th>
      <th scope="col">NOM CARGO</th>
      <th scope="col">ACCIONES</th>
    </tr>
  </thead>
  <tbody>
  <?php
						foreach ($cargo as $dato) {

					?>


					<tr>
						

						<td id="texto"><?php echo $dato -> COD_CARGO;  ?></td>
						<td id="texto"><?php echo $dato -> NOM_CARGO; ?></td>
						<td>
              <a href=""class="btn btn-success btn-rounded"  data-toggle="modal" data-target="#staticBackdrop1<?php echo $dato -> COD_CARGO;  ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Editar</a>
              <!--<a href="../validate/eliminar_cargo.php?id=<?php echo $dato -> COD_CARGO;  ?>" onclick="advertencia(event)" class="btn btn-danger btn-rounded"><i class="fa fa-trash" aria-hidden="true"></i></i>Eliminar</a>-->
            </td>
						</tr>
            <div class="modal fade" id="staticBackdrop1<?php echo $dato -> COD_CARGO;  ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header ">
                      <h5 class="modal-title text-center flex-grow-1" id="staticBackdropLabel">ACTUALIZAR CARGO</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px;">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form class="row g-3 needs-validation"action="../validate/actualizar_cargo.php" method="POST" novalidate>
                    <div class="modal-body">
                      <div class="col-md-5"><br>
                        <label for="validationCustom01" class="form-label">COD CARGO</label>
                        <input type="text" class="form-control" name="codigo"  value="<?php echo $dato -> COD_CARGO; ?>" >
                      </div> 
                      <div class="col-md-7"><br>
                        <label for="validationCustom01" class="form-label">NOM CARGO</label>
                        <input type="text" class="form-control" name="cargo"  value="<?php echo $dato -> NOM_CARGO; ?>" >
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
					<?php
						// code...
					} 
					?>
  </tbody>
  </table>
</div>

<?php
if(isset($_SESSION['cguardado'])){
  $res=$_SESSION['cguardado'];?>
  <script>
      Swal.fire({
        position: "top-end",
        icon: "success",
        title: "ACTUALIZADO...",
        text: "Se ha actualizado correctamente",
        showConfirmButton: false,
        timer: 2500
      });
  </script>
<?php
  unset($_SESSION['cguardado']);
}
?>
<?php
if(isset($_SESSION['cerror'])){
  $res=$_SESSION['cerror'];?>
  <script>
      Swal.fire({
        position: "top-end",
        icon: "error",
        title: "ERROR...",
        text: "Ups, ocurrio un error",
        showConfirmButton: false,
        timer: 2500
      });
  </script>
<?php
  unset($_SESSION['cerror']);
}
?>
<?php
if(isset($_SESSION['cvacio'])){
  $res=$_SESSION['cvacio'];?>
  <script>
      Swal.fire({
        position: "top-end",
        icon: "info",
        title: "VACIO ...",
        text: "Ups, complete todos los campos",
        showConfirmButton: false,
        timer: 2500
      });
  </script>
<?php
  unset($_SESSION['cvacio']);
}
?>

<!-- Button trigger modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title text-center flex-grow-1" id="staticBackdropLabel">REGISTRAR NUEVO CARGO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  action="../validate/registrar_cargo.php" method="POST" novalidate>
      <div class="modal-body"> 
        <div class="col-md-5">
          <label for="validationCustom01" class="form-label">COD CARGO</label>
          <input type="text" class="form-control" name="codigo" placeholder="CAR000"  >
        </div>
        <div class="col-md-7">
          <label for="validationCustom02" class="form-label">NOM CARGO</label>
          <input type="text" class="form-control" name="cargo" ><br>
        </div>
        </div>
        <div class="modal-footer"><br>
            <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Volver</button>
            <button type="submit" class="btn btn-primary btn-rounded">Registrar</button>
          </div>
      </form>
    </div>
    </div>
  </div>
<?php
if(isset($_SESSION['calerta'])){
  $res=$_SESSION['calerta'];?>
  <script>
      Swal.fire({
        position: "top-end",
        icon: "success",
        title: "GUARDADO...",
        text: "Se ha guardado correctamente",
        showConfirmButton: false,
        timer: 2500
      });
  </script>
<?php
  unset($_SESSION['calerta']);
}
?>
<?php
if(isset($_SESSION['cexiste'])){
  $res=$_SESSION['cexiste'];?>
  <script>
      Swal.fire({
        position: "top-end",
        icon: "info",
        title: "Ups ...",
        text: "Datos ya existentes",
        showConfirmButton: false,
        timer: 2500
      });
  </script>
<?php
  unset($_SESSION['cexiste']);
}
?>
<?php
if(isset($_SESSION['cerror'])){
  $res=$_SESSION['cerror'];?>
  <script>
      Swal.fire({
        position: "top-end",
        icon: "error",
        title: "ERROR...",
        text: "Ups, ocurrio un error",
        showConfirmButton: false,
        timer: 2500
      });
  </script>
<?php
  unset($_SESSION['cerror']);
}
?>
<?php
if(isset($_SESSION['cvacio'])){
  $res=$_SESSION['cvacio'];?>
  <script>
      Swal.fire({
        position: "top-end",
        icon: "info",
        title: "VACIO ...",
        text: "Ups, complete todos los campos",
        showConfirmButton: false,
        timer: 2500
      });
  </script>
<?php
  unset($_SESSION['cvacio']);
}
?>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>