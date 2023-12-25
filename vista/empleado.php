<?php
session_start();
if(empty($_SESSION['id'])){
	header("location: login/login.php");
}elseif(isset($_SESSION["id"])){
  include "../conexion.php";
  $consulta="SELECT * from tblempleado,tblcargo,tblarea where tblempleado.cod_cargo=tblcargo.cod_cargo 
  and tblempleado.cod_area=tblarea.cod_area";	
  $resultado = $cn->query($consulta); 
}
else{
  echo "Error al iniciar sesion";
}	
$empleado = $resultado->fetchAll(PDO::FETCH_OBJ);

?>
<?php
            include "../conexion.php";
          // Consulta para obtener los datos de la tabla 'tblcargo'
            $consulta_cargos = "SELECT COD_CARGO,NOM_CARGO FROM TBLCARGO";
            $stmt_cargos = $cn->query($consulta_cargos);
            $cargos = $stmt_cargos->fetchAll(PDO::FETCH_ASSOC);
              
          ?>
                                      <?php
            include "../conexion.php";
          // Consulta para obtener los datos de la tabla 'tblcargo'
            $consulta_areas = "SELECT COD_AREA,NOM_AREA FROM TBLAREA";
            $stmt_areas = $cn->query($consulta_areas);
            $areas = $stmt_areas->fetchAll(PDO::FETCH_ASSOC);
              
          ?>
<style>
  ul li:nth-child(3) .activo{
    background: rgb(11, 150, 214) !important;
  }
</style>
<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>



<!-- inicio del contenido principal -->
<div class="page-content">
  <h2 class="text-center">LISTA DE EMPLEADOS</h2>

  <a href=""class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-plus" aria-hidden="true"></i>REGISTRAR</a>
<div style="overflow-x: auto;">
  <table class="table table-sm" id="example" style="width: 100%; max-width: 100%;">
    <!-- ... Tu contenido de la tabla ... -->
              <thead>
              <tr>
                <th scope="col">DNI</th>
                <th scope="col">NOMBRES</th>
                <th scope="col">APELLIDOS</th>
                <th scope="col">CELULAR</th>
                <th scope="col">CORREO</th>
                <th scope="col">AREA</th>
                <th scope="col">CARGO</th>
                <th scope="col">ACCIONES</th>
              </tr>
            </thead>
            <tbody>
            <?php
						foreach ($empleado as $dato) {

					?>


					<tr>
						

						<td id="texto"><?php echo $dato -> DNI;  ?></td>
						<td id="texto"><?php echo $dato -> NOMBRES; ?></td>
						<td id="texto"><?php echo $dato -> APELLIDOS;  ?></td>
						<td id="texto"><?php echo $dato -> CELULAR;  ?></td>
						<td id="texto"><?php echo $dato -> CORREO;  ?></td>
						<td id="texto"><?php echo $dato -> NOM_AREA;  ?></td>
            <td id="texto"><?php echo $dato -> NOM_CARGO;  ?></td>
						<td>
              <a href=""class="btn btn-success btn-rounded"  data-toggle="modal" data-target="#staticBackdrop1<?php echo $dato -> DNI;  ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Editar</a>
              <a href="../validate/eliminar_empleado.php?id=<?php echo $dato -> DNI;  ?>" onclick="advertencia(event)" class="btn btn-danger btn-rounded"><i class="fa fa-trash" aria-hidden="true"></i></i>Eliminar</a>
            </td>
					</tr>
            <div class="modal fade" id="staticBackdrop1<?php echo $dato -> DNI;  ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header ">
                      <h5 class="modal-title text-center flex-grow-1" id="staticBackdropLabel">ACTUALIZAR EMPLEADO</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px;">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  <form class="row g-3 needs-validation"action="../validate/actualizar_empleado.php" method="POST" novalidate>
                    <div class="modal-body">
                      <div class="col-md-3"><br>
                        <label for="validationCustom01" class="form-label">DNI</label>
                        <input type="text" class="form-control" name="dni"  value="<?php echo $dato -> DNI; ?>" >
                      </div> 
                      <div class="col-md-4"><br>
                        <label for="validationCustom01" class="form-label">NOMBRES</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $dato -> NOMBRES; ?>" >
                      </div>
                      <div class="col-md-5"><br>
                        <label for="validationCustom02" class="form-label">APELLIDOS</label>
                        <input type="text" class="form-control"name="apellido" value="<?php echo $dato -> APELLIDOS; ?>" >
                      </div>
                      <div class="col-md-6"><br>
                        <label for="validationCustom02" class="form-label">CELULAR</label>
                        <input type="text" class="form-control" name="celular" value="<?php echo $dato -> CELULAR; ?>" >
                      </div>
                      <div class="col-md-6"><br>
                        <label for="validationCustom02" class="form-label">CORREO</label>
                        <input type="text" class="form-control" name="correo" value="<?php echo $dato -> CORREO; ?>" >
                      </div>
                      <div class="col-md-6">
                        <br>
                        <label class="form-label">AREA</label>
                        <select class="form-select" name="area" required>
                            <option value="" disabled>Seleccione un área</option>
                            <option value="<?php echo $dato->COD_AREA; ?>" selected><?php echo $dato->NOM_AREA; ?></option>
                            <?php
                            // Iterar sobre los datos de la tabla 'tblarea' para crear las opciones
                            foreach ($areas as $areaOption) {
                                if ($areaOption['COD_AREA'] !== $dato->COD_AREA) {
                                    echo "<option value='" . $areaOption['COD_AREA'] . "'>" . $areaOption['NOM_AREA'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                      <br>
                      <label class="form-label">CARGO</label>
                      <select class="form-select" name="cargo" required>
                          <option value="" disabled>Seleccione un cargo</option>
                          <option value="<?php echo $dato->COD_CARGO; ?>" selected><?php echo $dato->NOM_CARGO; ?></option>
                          <?php
                          // Iterar sobre los datos de la tabla 'tblcargo' para crear las opciones
                          foreach ($cargos as $cargo) {
                              if ($cargo['COD_CARGO'] !== $dato->COD_CARGO) {
                                  echo "<option value='" . $cargo['COD_CARGO'] . "'>" . $cargo['NOM_CARGO'] . "</option>";
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
if(isset($_SESSION['eguardado'])){
  $res=$_SESSION['eguardado'];?>
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
  unset($_SESSION['eguardado']);
}
?>
<?php
if(isset($_SESSION['eerror'])){
  $res=$_SESSION['eerror'];?>
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
  unset($_SESSION['eerror']);
}
?>
<?php
if(isset($_SESSION['evacio'])){
  $res=$_SESSION['evacio'];?>
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
  unset($_SESSION['evacio']);
}
?>

<!-- Button trigger modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title text-center flex-grow-1" id="staticBackdropLabel">REGISTRAR NUEVO EMPLEADO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  action="../validate/registrar_empleado.php" method="POST" novalidate>
      <div class="modal-body"> 
        <div class="col-md-3">
          <label for="validationCustom01" class="form-label">DNI</label>
          <input type="text" class="form-control" name="dni"   >
        </div>
        <div class="col-md-4">
          <label for="validationCustom01" class="form-label">NOMBRES</label>
          <input type="text" class="form-control" name="nombre"  >
        </div>
        <div class="col-md-5">
          <label for="validationCustom02" class="form-label">APELLIDOS</label>
          <input type="text" class="form-control"name="apellido"  ><br>
          </div>
          <div class="col-md-5">
          <label for="validationCustom02" class="form-label">CELULAR</label>
          <input type="email" class="form-control" name="celular" >
        </div>
        <div class="col-md-7">
          <label for="validationCustom02" class="form-label">CORREO</label>
          <input type="email" class="form-control" name="correo" >
        </div>
          <div class="col-md-6"><br>
            <label class="form-label">AREA</label>
            <select class="form-select" name="area" required>
                <option value="" selected disabled>Seleccione un area</option><br>
                <?php
                // Iterar sobre los datos de la tabla 'tblcargo' para crear las opciones
                foreach ($areas as $area) {
                    echo "<option value='" . $area['COD_AREA'] . "'>" . $area['NOM_AREA'] . "</option>";
                }
                ?>
            </select><br>
        </div>
        <div class="col-md-6"><br>
            <label class="form-label">CARGO</label>
            <select class="form-select" name="cargo" required>
                <option value="" selected disabled>Seleccione un cargo</option><br>
                <?php
                // Iterar sobre los datos de la tabla 'tblcargo' para crear las opciones
                foreach ($cargos as $cargo) {
                    echo "<option value='" . $cargo['COD_CARGO'] . "'>" . $cargo['NOM_CARGO'] . "</option>";
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
if(isset($_SESSION['emalerta'])){
  $res=$_SESSION['emalerta'];?>
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
  unset($_SESSION['emalerta']);
}
?>
<?php
if(isset($_SESSION['emexiste'])){
  $res=$_SESSION['emexiste'];?>
  <script>
      Swal.fire({
        position: "top-end",
        icon: "info",
        title: "Ups ...",
        text: "El empleado ya esta registrado!!!",
        showConfirmButton: false,
        timer: 2500
      });
  </script>
<?php
  unset($_SESSION['emexiste']);
}
?>
<?php
if(isset($_SESSION['emerror'])){
  $res=$_SESSION['emerror'];?>
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
  unset($_SESSION['emerror']);
}
?>
<?php
if(isset($_SESSION['emvacio'])){
  $res=$_SESSION['emvacio'];?>
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
  unset($_SESSION['emvacio']);
}
?>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>