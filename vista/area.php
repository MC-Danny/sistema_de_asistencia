<?php
session_start();
if(empty($_SESSION['id'])){
	header("location: login/login.php");
}elseif(isset($_SESSION["id"])){
  include "../conexion.php";
  $consulta="SELECT * from tblarea,tblempresa where tblarea.cod_emp=tblempresa.cod_emp";	
  $resultado = $cn->query($consulta); 
}
else{
  echo "Error al iniciar sesion";
}	
$area = $resultado->fetchAll(PDO::FETCH_OBJ);

?>
<style>
  ul li:nth-child(5) .activo{
    background: rgb(11, 150, 214) !important;
  }
</style>
<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>
<?php
            include "../conexion.php";
          // Consulta para obtener los datos de la tabla 'tblcargo'
            $consulta_cargos = "SELECT * FROM tblempresa";
            $stmt_cargos = $cn->query($consulta_cargos);
            $empresa = $stmt_cargos->fetchAll(PDO::FETCH_ASSOC);
              
          ?>
<!-- inicio del contenido principal -->
<div class="page-content">
  <h2 class="text-center">LISTA DE AREAS</h2>

  <a href=""class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-plus" aria-hidden="true"></i>REGISTRAR</a>
<div style="overflow-x: auto;">
  <table class="table table-sm" id="example" style="width: 100%; max-width: 100%;">
    <!-- ... Tu contenido de la tabla ... -->
    <thead>
    <tr>
      <th scope="col">COD AREA</th>
      <th scope="col">NOM AREA</th>
      <th scope="col">TELEFONO</th>
      <th scope="col">UBICACION</th>
      <th scope="col">EMPRESA</th>
      <th scope="col">ACCIONES</th>
    </tr>
  </thead>
  <tbody>
  <?php
						foreach ($area as $dato) {

					?>


					<tr>
						

						<td id="texto"><?php echo $dato -> COD_AREA;  ?></td>
						<td id="texto"><?php echo $dato -> NOM_AREA; ?></td>
						<td id="texto"><?php echo $dato -> TEL_AREA;  ?></td>
						<td id="texto"><?php echo $dato -> UBI_AREA;  ?></td>
						<td id="texto"><?php echo $dato -> NOM_EMP;  ?></td>
						<td>
              <a href=""class="btn btn-success btn-rounded"  data-toggle="modal" data-target="#staticBackdrop1<?php echo $dato -> COD_AREA;  ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Editar</a>
              <!--<a href="../validate/eliminar_area.php?id=<?php echo $dato -> COD_AREA;  ?>" onclick="advertencia(event)" class="btn btn-danger btn-rounded"><i class="fa fa-trash" aria-hidden="true"></i></i>Eliminar</a>-->
            </td>
						</tr>
            <div class="modal fade" id="staticBackdrop1<?php echo $dato -> COD_AREA;  ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header ">
                      <h5 class="modal-title text-center flex-grow-1" id="staticBackdropLabel">ACTUALIZAR AREA</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px;">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form class="row g-3 needs-validation"action="../validate/actualizar_area.php" method="POST" novalidate>
                    <div class="modal-body">
                      <div class="col-md-4"><br>
                        <label for="validationCustom01" class="form-label">CODIGO</label>
                        <input type="text" class="form-control" name="codigo"  value="<?php echo $dato -> COD_AREA; ?>" >
                      </div> 
                      <div class="col-md-4"><br>
                        <label for="validationCustom01" class="form-label">NOM AREA</label>
                        <input type="text" class="form-control" name="area"  value="<?php echo $dato -> NOM_AREA; ?>" >
                      </div>
                      <div class="col-md-4"><br>
                        <label for="validationCustom02" class="form-label">TELEFONO</label>
                        <input type="text" class="form-control" name="telefono" value="<?php echo $dato -> TEL_AREA; ?>" >
                      </div>
                      <div class="col-md-7"><br>
                        <label for="validationCustom01" class="form-label">UBICACION</label>
                        <input type="text" class="form-control" name="ubicacion" value="<?php echo $dato -> UBI_AREA; ?>" >
                      </div>
                      <div class="col-md-5"><br>
                        <label class="form-label">EMPRESA</label>
                        <select class="form-select" name="empresa" >
                            <option value="" disabled>Seleccione un área</option>
                            <option value="<?php echo $dato->COD_EMP; ?>" selected><?php echo $dato->NOM_EMP; ?></option>
                            <?php
                            // Iterar sobre los datos de la tabla 'tblarea' para crear las opciones
                            foreach ($empresa as $emp) {
                                if ($emp['COD_EMP'] !== $dato->COD_EMP) {
                                    echo "<option value='" . $emp['COD_EMP'] . "'>" . $emp['NOM_EMP'] . "</option>";
                                }
                            }
                            ?>
                        </select>
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
if(isset($_SESSION['aguardado'])){
  $res=$_SESSION['aguardado'];?>
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
  unset($_SESSION['aguardado']);
}
?>
<?php
if(isset($_SESSION['aerror'])){
  $res=$_SESSION['aerror'];?>
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
  unset($_SESSION['aerror']);
}
?>
<?php
if(isset($_SESSION['avacio'])){
  $res=$_SESSION['avacio'];?>
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
  unset($_SESSION['avacio']);
}
?>

<!-- Button trigger modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title text-center flex-grow-1" id="staticBackdropLabel">REGISTRAR NUEVO AREA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  action="../validate/registrar_area.php" method="POST" novalidate>
      <div class="modal-body"> 
        <div class="col-md-4">
          <label for="validationCustom01" class="form-label">COD AREA</label>
          <input type="text" class="form-control" name="codigo" placeholder="AREA00"   >
        </div>
        <div class="col-md-4">
          <label for="validationCustom02" class="form-label">NOM AREA</label>
          <input type="text" class="form-control" name="area" >
        </div>
        <div class="col-md-4">
          <label for="validationCustom01" class="form-label">TELEFONO</label>
          <input type="text" class="form-control" name="telefono" >
        </div>
        <div class="col-md-7"><br>
          <label for="validationCustom02" class="form-label">UBICACION</label>
          <input type="text" class="form-control"name="ubicacion" placeholder="ejemplo: Piso 3, Puerta N° 000" ><br>
          </div>

          <div class="col-md-5"><br>
            <label class="form-label">EMPRESA</label>
            <select class="form-select" name="empresa">
                <option value="" selected disabled>Seleccione un cargo</option><br>
                <?php
                // Iterar sobre los datos de la tabla 'tblcargo' para crear las opciones
                foreach ($empresa as $cargo) {
                    echo "<option value='" . $cargo['COD_EMP'] . "'>" . $cargo['NOM_EMP'] . "</option>";
                }
                ?>
            </select><br>
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Volver</button>
            <button type="submit" class="btn btn-primary btn-rounded">Registrar</button>
          </div>
      </form>
    </div>
    </div>
  </div>
<?php
if(isset($_SESSION['aalerta'])){
  $res=$_SESSION['aalerta'];?>
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
  unset($_SESSION['aalerta']);
}
?>
<?php
if(isset($_SESSION['aexiste'])){
  $res=$_SESSION['aexiste'];?>
  <script>
      Swal.fire({
        position: "top-end",
        icon: "info",
        title: "Ups ...",
        text: "El usuario ya existe",
        showConfirmButton: false,
        timer: 2500
      });
  </script>
<?php
  unset($_SESSION['aexiste']);
}
?>
<?php
if(isset($_SESSION['aerror'])){
  $res=$_SESSION['aerror'];?>
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
  unset($_SESSION['aerror']);
}
?>
<?php
if(isset($_SESSION['avacio'])){
  $res=$_SESSION['avacio'];?>
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
  unset($_SESSION['avacio']);
}
?>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>