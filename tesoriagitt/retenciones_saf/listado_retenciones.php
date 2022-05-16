 <?php

error_reporting ( E_ERROR ); 
//conexion

	 /*  	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	*/
	
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
	
	
	$fechaant = $_GET['fechad'];
    $fechahoy = $_GET['fechah'];  
	
	
 	$id = $_GET['id'];
  
	
	$ssql = "SELECT *
FROM `codigo_retencion` ";
     if (!($r_codigo= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar codigo";
      echo $cuerpo1;
      //.....................................................................
    }    
	
	
	$ssql = "SELECT * FROM `beneficiarios_aprobados` WHERE id_beneficiario='$id'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar beneficiario";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_beneficiario= mysql_fetch_array ($r_beneficiario);

	   
  $cuitl = $f_beneficiario['cuitl'];
  $ape = $f_beneficiario['apellido'];  
  $nom = $f_beneficiario['nombre'];  
  $razon_social = $f_beneficiario['razon_social'];  
 
 
  $ingreso_bruto = $f_beneficiario['ingreso_bruto'];
  $iva_situacion = $f_beneficiario['iva_situacion'];
  $ganancia = $f_beneficiario['ganancia'];
  $ingreso = $f_beneficiario['ingreso'];
  $regimen = $f_beneficiario['regimen'];
  $seguridad = $f_beneficiario['seguridad'];
  $ingreso_bruto_ac=$f_beneficiario['ingreso_bruto_ac'];



     $ssql = "SELECT * FROM iva where id_iva='$iva_situacion'";
     if (!($r_iva= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de cuenta";
      echo $cuerpo1;
      //.....................................................................
    } 
	
	$f_iva= mysql_fetch_array ($r_iva);
	$iva_situacion_n=$f_iva['nombre']; 
	
$ssql = "SELECT * FROM ganancias where id_ganancia='$ganancia'  order by nombre";
     if (!($r_ganancia= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }      
    $f_ganancia= mysql_fetch_array ($r_ganancia);
	$ganancia=$f_ganancia['nombre']; 	  

  $ssql = "SELECT * FROM ingreso_bruto  where id_ingreso='$ingreso' order by nombre ";
     if (!($r_ingreso= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	 $f_ingreso= mysql_fetch_array ($r_ingreso);
	 $ingreso=$f_ingreso['nombre']; 	  
	
	$ssql = "SELECT * FROM regimen where id_regimen='$regimen' order by nombre ";
     if (!($r_regimen= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }   
	
	 $f_regimen= mysql_fetch_array ($r_regimen);
	 $regimen=$f_regimen['nombre']; 	  
	

	
	$ssql = "SELECT * FROM seguridad_social where id_seguridad='$seguridad'  order by nombre ";
     if (!($r_seguridad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }          
     $f_seguridad= mysql_fetch_array ($r_seguridad);
	 $seguridad=$f_seguridad['nombre']; 	  
     
   
	
///////////////////////////////////////////////////////////////////////////////////////

    
$ssql="SELECT DISTINCT orden_pago, orden_pago.liquido FROM `orden_pago`,dd_retenciones
		WHERE (
		(
		orden_pago.`cuit` ='$cuitl'
		)
        AND (
		`orden_pago`.`fecha` >= '$fechaant'
		)
		AND (
		`orden_pago`.`fecha` <= '$fechahoy'
		)
		and (orden_pago=orden)
        and (orden_pago.ejercicio=dd_retenciones.ejercicio)
		
)";


 if (!($r_tn= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar total retencion";
      echo $cuerpo1;
      //.....................................................................
    }          

$ssql="SELECT DISTINCT orden_pago,orden_pago.importe FROM `orden_pago`,dd_retenciones
		WHERE (
		(
		orden_pago.`cuit` ='$cuitl'
		)
        AND (
		`orden_pago`.`fecha` >= '$fechaant'
		)
		AND (
		`orden_pago`.`fecha` <= '$fechahoy'
		)
		and (orden_pago=orden)
        and (orden_pago.ejercicio=dd_retenciones.ejercicio)
		
)";


 if (!($r_tb= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar total retencion1";
      echo $cuerpo1;
      //.....................................................................
    }          


define('FPDF_FONTPATH','font/');
require('../fpdf.php');

//Connect to your database
//Create new pdf file
$pdf=new FPDF();
//$pdf=new PDF_AutoPrint();
$pdf=new FPDF('P','mm','A4');
//Open file
$pdf->Open();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage();

//$pdf->SetTopMargin(25);

$y_axis_initial = 25;

// imprime el titulo de la pagina
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',11);
$pdf->SetY($y_axis_initial);
//$pdf->SetY(20);
$pdf->SetFillColor(256,256,256);
//$pdf->SetFont('Arial','I',6);
$pdf->setY(10);
$pdf->Image('../img/membrete1.jpg',25,8,0);
//$pdf->SetX(105);
$pdf->SetFont('Arial','B',4);
//$pdf->Cell(0,6,'TESORERIA GENERAL DE LA PROVINCIA',0,'B','L',0);
//$pdf->setY(23);
//$pdf->Cell(0,6,'CONTADURIA GENERAL DE LA PROVINCIA',0,'B','L',0);
//$pdf->Image('../img/cuadro.jpg',170,15,15);
/////////FECHA///////

$pdf->SetFont('Arial','B',6);
//$pdf->setX(150);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
//$pdf->setY(25);
$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),

////ENCABEZADO

$pdf->SetFont('Arial','IB',7);
$pdf->setY(45);
$pdf->cell(0,0,'CONSTANCIA DE CONSULTA DE RETENCION',0,'B','C',0);

$pdf->SetFont('Arial','IB',7);
$pdf->setY(52);
$pdf->cell(0,0,'MODULO DE IMPUESTOS Y RETENCIONES',0,'B','C',0);



$y_axis_initial = 65;


$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($y_axis_initial);
$pdf->SetX(15);
$pdf->Cell(10,7,'Nº CUIL | CUIT : ',1,0,'C',1);
$pdf->SetX(30);
$pdf->Cell(10,7,$cuitl,1,0,'C',1);
$i = 0;

//Set maximum rows per page
$max = 30;
$y_axis=62;
//Set Row Height
$row_height = 7;
$cont=0;

/*
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($y_axis_initial);
$pdf->SetX(15);
$pdf->Cell(10,7,'Nº',1,0,'C',1);
$pdf->Cell(20,7,'EJERCICIO',1,0,'C',1);
$pdf->Cell(20,7,'FECHA',1,0,'C',1);
$pdf->Cell(18,7,'SAF',1,0,'C',1);
$pdf->Cell(27,7,'ORDEN DE PAGO',1,0,'C',1);
$pdf->Cell(70,7,'CONCEPTO',1,0,'C',1);
$pdf->Cell(30,7,'TOTAL',1,0,'C',1);

$i = 0;

//Set maximum rows per page
$max = 30;
$y_axis=62;
//Set Row Height
$row_height = 7;
$cont=0;

while($f_ordenes= mysql_fetch_array ($ordenes))
{
			   
			//If the current row is the last one, create new page and print column title
			if ($i == $max)
			{
							//Add first page
		    $pdf->AddPage();

			//$pdf->SetTopMargin(25);
			
			$y_axis_initial = 25;
			
			// imprime el titulo de la pagina
			$pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',11);
			$pdf->SetY($y_axis_initial);
			//$pdf->SetY(20);
			$pdf->SetFillColor(256,256,256);
			//$pdf->SetFont('Arial','I',6);
			$pdf->setY(10);
			$pdf->Image('../img/membrete1.jpg',25,8,0);
			//$pdf->SetX(105);
			$pdf->SetFont('Arial','B',4);
			//$pdf->Cell(0,6,'TESORERIA GENERAL DE LA PROVINCIA',0,'B','L',0);
			//$pdf->setY(23);
			//$pdf->Cell(0,6,'CONTADURIA GENERAL DE LA PROVINCIA',0,'B','L',0);
			//$pdf->Image('../img/cuadro.jpg',170,15,15);
			/////////FECHA///////
			
			$pdf->SetFont('Arial','B',6);
			//$pdf->setX(150);
			// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
			//$pdf->setY(25);
			$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
			// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
			
			////ENCABEZADO
			
			$pdf->SetFont('Arial','IB',7);
			$pdf->setY(45);
			$pdf->cell(0,0,'LISTADO DE ORDENES DE PAGO',0,'B','C',0);
			
			
			$y_axis_initial = 55;
			
			$pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',8);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(15);
			$pdf->Cell(10,7,'Nº',1,0,'C',1);
			$pdf->Cell(20,7,'EJERCICIO',1,0,'C',1);
			$pdf->Cell(20,7,'FECHA',1,0,'C',1);
			$pdf->Cell(18,7,'SAF',1,0,'C',1);
			$pdf->Cell(27,7,'ORDEN DE PAGO',1,0,'C',1);
			$pdf->Cell(70,7,'CONCEPTO',1,0,'C',1);
			$pdf->Cell(30,7,'TOTAL',1,0,'C',1);
			
			$i = 0;
			
			//Set maximum rows per page
			$max = 30;
			$y_axis=62;
			//Set Row Height
			$row_height = 7;
			

        //Set $i variable to 0 (first row)
        
    }

       $fecha=$f_ordenes['fecha'];
       $saf=$f_ordenes['saf'];
       $orden_pago=$f_ordenes['orden_pago'];
	   $concepto=$f_ordenes['concepto'];
	   $total=$f_ordenes['total'];
	   $ejercicio=$f_ordenes['ejercicio'];
	   
	   
	$pdf->SetFont('courier',$negra,8);
	$pdf->SetY($y_axis);
	$pdf->SetX(15);
	$cont=$cont+1;
    $pdf->Cell(10,6,$cont,1,0,'C',1); 
	$pdf->Cell(20,6,$ejercicio,1,0,'C',1);
    $pdf->Cell(20,6,$fecha,1,0,'C',1);
	$pdf->Cell(18,6,$saf,1,0,'L',1);
	$pdf->Cell(27,6,$orden_pago,1,0,'C',1);
	$pdf->SetFont('courier',$negra,6);
    $pdf->Cell(70,6,$concepto,1,0,'L',1);
	$pdf->SetFont('courier',$negra,8);
	$pdf->Cell(30,6,$total,1,0,'R',1);
	
	
    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
}

$y_axis = $y_axis + $row_height;
///////////////////
$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');

*/
$pdf->AliasNbPages();

//////// fin Formacion ACademica
$pdf->Output();

?>


