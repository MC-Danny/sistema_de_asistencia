<?php

if(!empty($_POST['fechainicio']) and!empty($_POST['fechafinal']) 
and !empty($_POST['empleado']) ){
  require('./fpdf.php');
  $fechainicio = $_POST['fechainicio'];
  $fechafinal=$_POST['fechafinal'];
  $empleado=$_POST['empleado'];


  class PDF extends FPDF
  {

    // Cabecera de página
    function Header()
    {
        include '../../conexion.php';//llamamos a la conexion BD

        $consult="SELECT * from tblempresa WHERE COD_EMP='EMP001'";	
        $resultado = $cn->query($consult); 
        $empresa = $resultado->fetchAll(PDO::FETCH_OBJ);

        $this->Image('logo.png', 270, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
        $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $this->Cell(95); // Movernos a la derecha
        $this->SetTextColor(0, 0, 0); //color
        //creamos una celda o fila
        foreach ($empresa as $emp) {
          $this->Cell(110, 15, utf8_decode($emp->NOM_EMP), 0, 1, 'C', 0); // AnchoCelda, AltoCelda, título, borde(1-0), saltoLinea(1-0), posición(L-C-R), ColorFondo(1-0)
      } // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
        $this->Ln(3); // Salto de línea
        $this->SetTextColor(103); //color

        /* UBICACION */
        $this->Cell(10);  // mover a la derecha
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(96, 10, utf8_decode("Direccion :  $emp->DIRECCION"), 0, 0, '', 0);
        $this->Ln(5);

        /* TELEFONO */
        $this->Cell(10);  // mover a la derecha
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(59, 10, utf8_decode("Teléfono   :  $emp->TELEFONO"), 0, 0, '', 0);
        $this->Ln(5);

        /* COREEO */
        $this->Cell(10);  // mover a la derecha
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(85, 10, utf8_decode("RUC          :  $emp->RUC "), 0, 0, '', 0);
        $this->Ln(5);



        /* TITULO DE LA TABLA */
        //color
        $this->SetTextColor(228, 100, 0);
        $this->Cell(100); // mover a la derecha
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(100, 10, utf8_decode("REPORTE DE ASISTENCIA "), 0, 1, 'C', 0);
        $this->SetFillColor(228, 100, 0); //colorFondo
        $this->SetTextColor(255, 255, 255); //colorTexto
        $this->SetDrawColor(163, 163, 163); //colorBorde
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(15, 10, utf8_decode('N°'), 1, 0, 'C', 1);
        $this->Cell(20, 10, utf8_decode('DNI'), 1, 0, 'C', 1);
        $this->Cell(72, 10, utf8_decode('NOMBRES Y APELLIDOS'), 1, 0, 'C', 1);
        $this->Cell(42, 10, utf8_decode('ENTRADA'), 1, 0, 'C', 1);
        $this->Cell(42, 10, utf8_decode('SALIDA'), 1, 0, 'C', 1);
        $this->Cell(49, 10, utf8_decode('CARGO'), 1, 0, 'C', 1);
        $this->Cell(38, 10, utf8_decode('TOTAL HRS'), 1, 1, 'C', 1);
        
        
      
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15); // Posición: a 1,5 cm del final
        $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

        $this->SetY(-15); // Posición: a 1,5 cm del final
        $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
        $hoy = date('d/m/Y');
        $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
    }
  }

  include '../../conexion.php';
  //require '../../funciones/CortarCadena.php';
  /* CONSULTA INFORMACION DEL HOSPEDAJE */
  //$consulta_info = $conexion->query(" select *from hotel ");
  //$dato_info = $consulta_info->fetch_object();

  $pdf = new PDF();
  $pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
  $pdf->AliasNbPages(); //muestra la pagina / y total de paginas

  $i = 0;
  $pdf->SetFont('Arial', '', 11);
  $pdf->SetDrawColor(163, 163, 163); // colorBorde
  
if($empleado=='todos') {
  $sql=" SELECT A.COD_ASIS,E.DNI,E.NOMBRES,E.APELLIDOS,
  A.ENTRADA,A.SALIDA,C.NOM_CARGO AS nomcargo,
  TIMEDIFF(A.SALIDA, A.ENTRADA) AS TOTAL_HORAS
FROM TBLASISTENCIA A
INNER JOIN TBLEMPLEADO E ON A.DNI = E.DNI
LEFT JOIN TBLCARGO C ON E.COD_CARGO = C.COD_CARGO WHERE A.ENTRADA BETWEEN '$fechainicio' and '$fechafinal'
ORDER BY E.DNI ASC;";
}
else{
  $sql=" SELECT A.COD_ASIS,E.DNI,E.NOMBRES,E.APELLIDOS,A.ENTRADA,
  A.SALIDA,C.NOM_CARGO AS nomcargo,
  TIMEDIFF(A.SALIDA, A.ENTRADA) AS TOTAL_HORAS
FROM TBLASISTENCIA A
INNER JOIN TBLEMPLEADO E ON A.DNI = E.DNI
LEFT JOIN TBLCARGO C ON E.COD_CARGO = C.COD_CARGO WHERE A.DNI='$empleado' and A.ENTRADA BETWEEN '$fechainicio' and '$fechafinal'
ORDER BY E.DNI ASC;";
  }
  $resultado = $cn->query($sql);

  // Start the loop
  while ($datos = $resultado->fetch(PDO::FETCH_OBJ)) {
    $i = $i + 1;
      /* TABLA */
    $pdf->Cell(15, 7, utf8_decode("$datos->COD_ASIS"), 1, 0, 'C', 0);
    $pdf->Cell(20, 7, utf8_decode($datos->DNI), 1, 0, 'C', 0);
    $pdf->Cell(72, 7, utf8_decode($datos->NOMBRES." ".$datos->APELLIDOS), 1, 0, 'L', 0);
    $pdf->Cell(42, 7, utf8_decode($datos->ENTRADA), 1, 0, 'L', 0);
    $pdf->Cell(42, 7, utf8_decode($datos->SALIDA), 1, 0, 'L', 0);
    $pdf->Cell(49, 7, utf8_decode($datos->nomcargo), 1, 0, 'L', 0);
    $pdf->Cell(38, 7, utf8_decode($datos->TOTAL_HORAS), 1, 1, 'L', 0);
    

  }
  
  $pdf->Output('Reporte Asistencia.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)


}
