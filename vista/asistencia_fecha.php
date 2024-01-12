<?php
session_start();
if(empty($_SESSION['id'])){
	header("location: login/login.php");
}

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
<!-- Button trigger modal -->

      <form  action="fpdf/reporte_asistencia_fecha.php" method="POST">
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
          <select class="form-select" name="estado" required>
            <option selected disabled value="todos">Todos los empleados</option>
            <option value="1">1</option>

          </select>
        </div>
          <button type="submit"  class="btn btn-primary btn-rounded">Actualizar</button> 
      </form>
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