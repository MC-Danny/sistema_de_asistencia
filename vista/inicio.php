<?php
session_start();
if(empty($_SESSION['id'])){
	header("location: login/login.php");
}elseif(isset($_SESSION["id"])){
  include "../conexion.php";
  $consulta="SELECT 
  A.COD_ASIS,
  E.DNI,
  E.NOMBRES,
  E.APELLIDOS,
  A.ENTRADA,
  A.SALIDA,
  AR.NOM_AREA AS nomarea,
  C.NOM_CARGO AS nomcargo
FROM 
  TBLASISTENCIA A
INNER JOIN 
  TBLEMPLEADO E ON A.DNI = E.DNI
LEFT JOIN 
  TBLAREA AR ON E.COD_AREA = AR.COD_AREA
LEFT JOIN 
  TBLCARGO C ON E.COD_CARGO = C.COD_CARGO;
";	
  $resultado = $cn->query($consulta); 
}
else{
  echo "Error al iniciar sesion";
}	
$asistencia = $resultado->fetchAll(PDO::FETCH_OBJ);

?>
<style>
  ul li:nth-child(1) .activo{
    background: rgb(11, 150, 214) !important;
  }
</style>
<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">
  <h2 class="text-center">REGISTRO DE ASISTENCIA</h2>

<div class="text-right mb-2">
<a href=""class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-plus-circle" aria-hidden="true"></i>  MAS REPORTES</a>
<a href="../excel/asistencia_excel.php" target="_blank" class="btn btn-success btn-rounded"><i class="fa fa-download" aria-hidden="true"></i>  EXCEL</a>
<a href="fpdf/PruebaH.php" target="_blank" class="btn btn-success btn-rounded"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  PDF</a>
</div>
 
<div style="overflow-x: auto;">
  <table class="table table-sm" id="example" style="width: 100%; max-width: 100%;">
    <!-- ... Tu contenido de la tabla ... -->
    <thead>
    <tr>
      <th scope="col">CODIGO</th>
      <th scope="col">DNI</th>
      <th scope="col">NOMBRES Y APELLIDOS</th>
      <th scope="col">ENTRADA</th>
      <th scope="col">SALIDA</th>
      <th scope="col">AREA</th>
      <th scope="col">CARGO</th>
      <th scope="col">ACCIÓN</th>
    </tr>
  </thead>
  <tbody>
  <?php
						foreach ($asistencia as $dato) {

					?>


					<tr>
						

						<td id="texto"><?php echo $dato -> COD_ASIS;  ?></td>
						<td id="texto"><?php echo $dato -> DNI; ?></td>
						<td id="texto"><?php echo $dato -> NOMBRES." ".$dato -> APELLIDOS;  ?></td>
						<td id="texto"><?php echo $dato -> ENTRADA;  ?></td>
						<td id="texto"><?php echo $dato -> SALIDA;  ?></td>
						<td id="texto"><?php echo $dato -> nomarea;  ?></td>
            <td id="texto"><?php echo $dato -> nomcargo;  ?></td>
						<td>
              <a href="../validate/eliminar_asistencia.php?id=<?php echo $dato -> COD_ASIS;  ?>" onclick="advertencia(event)" class="btn btn-danger btn-rounded"><i class="fa fa-trash" aria-hidden="true"></i></i>  Eliminar</a>
            </td>
						</tr>
            <div class="modal fade" id="staticBackdrop1<?php echo $dato -> COD_USER;  ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                      <div class="col-md-2"><br>
                        <label for="validationCustom01" class="form-label">ID</label>
                        <input type="text" class="form-control" name="codigo"  value="<?php echo $dato -> COD_USER; ?>" >
                      </div> 
                      <div class="col-md-4"><br>
                        <label for="validationCustom01" class="form-label">USUARIO</label>
                        <input type="text" class="form-control" name="usuario"  value="<?php echo $dato -> NOM_USER; ?>" >
                      </div>
                      <div class="col-md-6"><br>
                        <label for="validationCustom02" class="form-label">CONTRASEÑA</label>
                        <input type="text" class="form-control" name="contra" value="<?php echo $dato -> CONTRA; ?>" >
                      </div>
                      <div class="col-md-2"><br>
                        <label for="validationCustom04" class="form-label">ESTADO</label>
                        <select class="form-select" name="estado">
                          <option <?php echo ($dato->ESTADO == '') ? 'selected' : ''; ?> disabled value="">Choose...</option>
                          <option <?php echo ($dato->ESTADO == '1') ? 'selected' : ''; ?>>1</option>
                          <option <?php echo ($dato->ESTADO == '2') ? 'selected' : ''; ?>>2</option>
                        </select>
                      </div>
                      <div class="col-md-4"><br>
                        <label for="validationCustom01" class="form-label">NOMBRES</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $dato -> NOMBRES; ?>" >
                      </div>
                      <div class="col-md-6"><br>
                        <label for="validationCustom02" class="form-label">APELLIDOS</label>
                        <input type="text" class="form-control"name="apellido" value="<?php echo $dato -> APELLIDOS; ?>" >
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
if(isset($_SESSION['uguardado'])){
  $res=$_SESSION['uguardado'];?>
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
  unset($_SESSION['uguardado']);
}
?>
<?php
if(isset($_SESSION['uerror'])){
  $res=$_SESSION['uerror'];?>
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
  unset($_SESSION['uerror']);
}
?>
<?php
if(isset($_SESSION['uvacio'])){
  $res=$_SESSION['uvacio'];?>
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
  unset($_SESSION['uvacio']);
}
?>

<!-- Button trigger modal -->
<?php
            include "../conexion.php";
          // Consulta para obtener los datos de la tabla 
            $consulta = "SELECT * FROM TBLEMPLEADO";
            $stmt = $cn->query($consulta);
            $EMPLE = $stmt->fetchAll(PDO::FETCH_ASSOC);
              
          ?>
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title text-center flex-grow-1" id="staticBackdropLabel">ASISTENCIAS DE EMPLEADOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  action="fpdf/reporte_asistencia_fecha.php" method="POST">
      <div class="modal-body"> 
        <div class="col-md-12 mb-2">
          <label for="validationCustom01" class="form-label text-center">FECHA INICIO</label>
          <input type="date" class="form-control" name="fechainicio"  required >
        </div>
        <div class="col-md-12 mb-2">
          <label for="validationCustom02" class="form-label text-center">FECHA FINAL</label>
          <input type="date" class="form-control" name="fechafinal" required>
        </div>
        <div class="col-md-12 mb-2">
          <label for="validationCustom04" class="form-label text-center">EMPLEADO</label>
          <select class="form-select" name="empleado" required>
                <option value="todos">Seleccionar todos los empleados</option>
                <?php
                // Iterar sobre los datos de la tabla 'tblcargo' para crear las opciones
                foreach ($EMPLE as $EMPLEA) {
                    echo "<option value='" . $EMPLEA['DNI'] . "'>" . $EMPLEA['NOMBRES']." ". $EMPLEA['APELLIDOS'] . "</option>";
                }
                ?>
            </select>
        </div>
        </div>
        <div class="modal-footer">
          <button type="submit"  class="btn btn-primary btn-rounded">
            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>  GENERAR PDF</button> 
        </div>
      </form>
    </div>
    </div>
  </div>
<?php
if(isset($_SESSION['alerta'])){
  $res=$_SESSION['alerta'];?>
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
  unset($_SESSION['alerta']);
}
?>
<?php
if(isset($_SESSION['existe'])){
  $res=$_SESSION['existe'];?>
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
  unset($_SESSION['existe']);
}
?>
<?php
if(isset($_SESSION['error'])){
  $res=$_SESSION['error'];?>
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
  unset($_SESSION['error']);
}
?>
<?php
if(isset($_SESSION['vacio'])){
  $res=$_SESSION['vacio'];?>
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
  unset($_SESSION['vacio']);
}
?>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>