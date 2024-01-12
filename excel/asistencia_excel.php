<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=asistencia_reporte.xls");
?>

<?php
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
$asistencia = $resultado->fetchAll(PDO::FETCH_OBJ);

?>
<table class="table table-sm" ">
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
					
                        <?php
						// code...
					} 
					?>
  </tbody>
  </table>