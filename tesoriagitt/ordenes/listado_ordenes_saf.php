<?php
    
/*	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	*/

    include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    //include('conexion/extras.php');*/
 	
	///////////////////////////////////////////////////////
    $fechaant=$_GET['fehcaa'];
	$fechahoy=$_GET['fechah'];
	$nom=$_GET['saf'];
	$cuit_or=$_GET['cuit'];
	
	///////////////////
	
   $f=strftime("%Y-%m-%d");
   $dia = date("d/m/Y");
   $hora =date("h:i");
   
   
   
   /////////////////////////////
   
 
   
   
   ////////////////////////////
	
 if ($nom=='N' and $cuit_or=='')
    {
		 $_pagi_sql = "SELECT  o.fecha,o.saf,o.orden_pago,o.concepto,o.total,o.ejercicio,o.cuit
				  		      FROM orden_pago as o,nro_saf as s
							  WHERE  o.saf = s.numero 
							  and fecha >='$fechaant' and fecha <= '$fechahoy'
							 
							  ORDER BY ejercicio,`fecha` DESC,`orden_pago` ASC";
		
	}
if ($nom=='N' and $cuit_or!='')
    {
		 $_pagi_sql = "SELECT  o.fecha,o.saf,o.orden_pago,o.concepto,o.total,o.ejercicio,o.cuit
				  		      FROM orden_pago as o,nro_saf as s
							  WHERE  o.saf = s.numero 
							  and fecha >='$fechaant' and fecha <= '$fechahoy'
							 
							  and (o.cuit='$cuit_or' or  o.saf ='$cuit_or') 
							  ORDER BY ejercicio,`fecha` DESC,`orden_pago` ASC";
		
	}	
	
if($nom !='N' and $cuit_or=='')
    {
	
		 $_pagi_sql = "SELECT  o.fecha,o.saf,o.orden_pago,o.concepto,o.total,o.ejercicio,o.cuit
				  		      FROM orden_pago as o,nro_saf
							  WHERE  o.saf = numero 
							  and numero = '$nom'
							 
							  and fecha >='$fechaant' and fecha <= '$fechahoy'
							  ORDER BY ejercicio,`fecha` DESC,`orden_pago` ASC ";
							  
	}
	
if($cuit_or!='' and $nom !='N' )
    {
	
		 $_pagi_sql = "SELECT  o.fecha,o.saf,o.orden_pago,o.concepto,o.total,o.ejercicio,o.cuit
				  		      FROM orden_pago as o,nro_saf
							  WHERE  o.saf = numero 
							  and (o.cuit = '$cuit_or' or o.orden_pago = '$cuit_or')
							  and numero = '$nom'
							
							  and fecha >='$fechaant' and fecha <= '$fechahoy'
							  ORDER BY ejercicio,`fecha` DESC,`orden_pago` ASC ";
							  
	}	
	
	
	
	
			 if (!($ordenes= mysql_query($_pagi_sql, $conexion_mysql)))
			{
			
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes";
			  echo $cuerpo1;
			  //.....................................................................
			}  
			
						  
			  
		

  
  
define('FPDF_FONTPATH','font/');
require('../fpdf.php');

//Connect to your database
//Create new pdf file
$pdf=new FPDF();
//$pdf=new PDF_AutoPrint();
$pdf=new FPDF('L','mm','A4');
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
$pdf->Image('../img/membrete1.jpg',5,0,0);
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
$pdf->setY(30);
$pdf->cell(0,0,'LISTADO DE ORDENES DE PAGO FONDOS DE TESORO',0,'B','C',0);


$y_axis_initial = 40;

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($y_axis_initial);
$pdf->SetX(15);
$pdf->Cell(10,7,'N?',1,0,'C',1);
$pdf->Cell(20,7,'EJERCICIO',1,0,'C',1);
$pdf->Cell(20,7,'FECHA',1,0,'C',1);
$pdf->Cell(18,7,'SAF',1,0,'C',1);
$pdf->Cell(27,7,'ORDEN DE PAGO',1,0,'C',1);
$pdf->Cell(70,7,'BENEFICIARIO',1,0,'C',1);
$pdf->Cell(70,7,'CONCEPTO',1,0,'C',1);
$pdf->Cell(30,7,'TOTAL',1,0,'C',1);

$i = 0;

//Set maximum rows per page
$max = 20;
$y_axis=50;
//Set Row Height
$row_height = 7;
$cont=0;
$total_gral=0;
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
			$pdf->Image('../img/membrete1.jpg',5,0,0);
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
			$pdf->setY(30);
			$pdf->cell(0,0,'LISTADO DE ORDENES DE PAGO  FONDOS DE TESORO',0,'B','C',0);
			
			
			$y_axis_initial = 40;
			
			$pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',8);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(15);
			$pdf->Cell(10,7,'N?',1,0,'C',1);
			$pdf->Cell(20,7,'EJERCICIO',1,0,'C',1);
			$pdf->Cell(20,7,'FECHA',1,0,'C',1);
			$pdf->Cell(18,7,'SAF',1,0,'C',1);
			$pdf->Cell(27,7,'ORDEN DE PAGO',1,0,'C',1);
			$pdf->Cell(70,7,'BENEFICIARIO',1,0,'C',1);
			$pdf->Cell(70,7,'CONCEPTO',1,0,'C',1);
			$pdf->Cell(30,7,'TOTAL',1,0,'C',1);
			
			$i = 0;
			
			//Set maximum rows per page
			$max = 20;
			$y_axis=50;
			//Set Row Height
			$row_height = 7;
			

        //Set $i variable to 0 (first row)
        
    }
	
	 $cuit=$f_ordenes['cuit'];
     $ssql = "SELECT  b.nombre,b.apellido,b.razon_social
				  		      FROM beneficiarios_aprobados as b
							  WHERE b.cuitl='$cuit'
							  ";
				  
     	 if (!($r_bene= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			} 
			
				$f_bene =  mysql_fetch_array($r_bene);

       $fecha=$f_ordenes['fecha'];
       $saf=$f_ordenes['saf'];
       $orden_pago=$f_ordenes['orden_pago'];
	   $concepto=$f_ordenes['concepto'];
	   $total=$f_ordenes['total'];
	   $ejercicio=$f_ordenes['ejercicio'];
	   $nombre_be=$f_bene['nombre'];
	   $apellido=$f_bene['apellido'];
	   $razon=$f_bene['razon_social'];
	   
	   
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
	if($razon=='')
	  {
		   $pdf->Cell(70,6,$apellido.' '.$nombre_be,1,0,'L',1);
	  }
	 else
	  {
		   $pdf->Cell(70,6,$razon,1,0,'L',1);
	  }
    $pdf->Cell(70,6,$concepto,1,0,'L',1);
	$pdf->SetFont('courier',$negra,8);
	$pdf->Cell(30,6,$total,1,0,'R',1);
	
	
    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
	
	$total_gral=$total_gral+$total;
	
}
$pdf->SetFillColor(256,256,256);
 $pdf->SetFont('courier','B',12);
$pdf->SetY($y_axis+10);
$pdf->SetX(30);
$pdf->Cell(0,3,'Total Gral Transferencias:'.number_format($total_gral,2),0,0,'R',1);

///////////////////
$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');

$pdf->AliasNbPages();

//////// fin Formacion ACademica
$pdf->Output();
 
?>
