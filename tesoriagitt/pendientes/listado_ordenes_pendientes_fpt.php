<?php
    
   
	  include('../dgti-mysql-var_dbtgp.php');
    include('../dgti-intranet-mysql_connect.php');  
	include('../dgti-intranet-mysql_select_db.php');
    //include('conexion/extras.php');
 	
	///////////////////////////////////////////////////////
   
	$cuit=$_GET['dato'];
	 $fecha_cons=$_GET['consul'];
	  $saf=$_GET['saf'];
	///////////////////
	
	$f=strftime("%Y-%m-%d");
   $dia = date("d/m/Y");
   $hora =date("h:i");
   
   ////////////////////////////
	
   
		 $_pagi_sql = "SELECT orden_pago.* , (
IMP_FORM - RETENCION - IMPORTE_A_PAGAR +IMP_DESAF
) AS pagado, (
IMP_FORM - RETENCION
) AS Imp_orden, e.ESCRITURAL,e.DENOMINACION,e.ID
FROM orden_pago, escritural AS e
WHERE EJERCICIO = '$fecha_cons'
AND orden_pago.SAF='$saf'
AND e.ID = orden_pago.id_escritural
AND e.ESTADO='A'
AND orden_pago.ESTADO = 'P'
ORDER BY FECHA_OP desc,FORMULARIO,ESCRITURAL,NUMERO ";
							  
		
			 if (!($ordenes= mysql_query($_pagi_sql, $conexion_mysql)))
			{
			
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes";
			  echo $cuerpo1;
			  //.....................................................................
			}  
			
						  
			$ssql = "SELECT SUM( IMPORTE_A_PAGAR ) AS saldo, SUM( IMP_FORM - RETENCION - IMPORTE_A_PAGAR +IMP_DESAF ) AS total, SUM( IMP_FORM - RETENCION ) AS importe, count(NUMERO) AS cant
						FROM orden_pago,escritural AS e 
						WHERE EJERCICIO='$fecha_cons' 
						AND orden_pago.SAF='$saf'
						AND e.ID = orden_pago.id_escritural
						AND orden_pago.ESTADO ='P'
						AND e.ESTADO='A' ";
				 if (!($r_op= mysql_query($ssql, $conexion_mysql)))
				{
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar area";
				 
				  //.....................................................................
				}
  
	$f_orden=mysql_fetch_array($r_op);
    $saldo=$f_orden['saldo'];	
    $importe=$f_orden['importe']+$f_ordenp['IMP_DESAF'];
    $total=$f_orden['total'];

  
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
$pdf->cell(0,0,'LISTADO DE ORDENES DE PAGO PENDIENTES  '.$fecha_cons.' - '.'SAF '.$saf,0,'B','C',0);


$y_axis_initial = 55;

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',6);
$pdf->SetY($y_axis_initial);
$pdf->SetX(15);
$pdf->Cell(10,7,'Nº',1,0,'C',1);
$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
$pdf->Cell(65,7,'Beneficiarios',1,0,'C',1);
$pdf->Cell(65,7,'Concepto',1,0,'C',1);
$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);
$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
$pdf->Cell(30,7,'Estado',1,0,'C',1);








$i = 0;

//Set maximum rows per page
$max = 20;
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
			$pdf->cell(0,0,'LISTADO DE ORDENES DE PAGO PENDIENTES  '.$fecha_cons.' - '.'SAF '.$saf,0,'B','C',0);
			
			
			$y_axis_initial = 55;
			
			$pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',6);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(15);
			$pdf->Cell(10,7,'Nº',1,0,'C',1);
			$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
			$pdf->Cell(65,7,'Beneficiarios',1,0,'C',1);
			$pdf->Cell(65,7,'Concepto',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);
			$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
			$pdf->Cell(30,7,'Estado',1,0,'C',1);
						
			$i = 0;
			
			//Set maximum rows per page
			$max = 20;
			$y_axis=62;
			//Set Row Height
			$row_height = 7;
			

        //Set $i variable to 0 (first row)
        
    }

       $fecha=$f_ordenes['Fecha_OP'];
       $saf=$f_ordenes['Saf'];
      // $orden_pago=$f_ordenes['Numero_OP'];
	  // $sal_disp=$f_ordenes['Saldos'];
	  // $imp_form=$f_ordenes['Imp_orden'];
	  // $imp_pag=$f_ordenes['Total_Pagado'];
	   $benef=substr($f_ordenes['BENEFICIARIO'],0,40);
	   $concepto=substr($f_ordenes['CONCEPTO'],0,40);
	     $estado=$f_ordenes['ESTADO'];
	 //  $concepto=substr($f_ordenes['Concepto'],0,15);
	  
	       $d_cuit=$f_ordenes['CUIT'];
		   $orden=$f_ordenes['NUMERO'];
		   $op_saf=$f_ordenes['SAF'];
		   $ejer_op=$f_ordenes['EJERCICIO'];
		   $num=$f_ordenes['FORMULARIO']; 
		  
		   $IMP1= number_format($f_ordenes['IMP_FORM'],2);
		   $IMP2=number_format($f_ordenes['RETENCION'],2);
		   $IMP3=number_format($f_ordenes['IMPORTE_A_PAGAR'],2);
		   $Imp_orden=number_format($f_ordenes['Imp_orden'],2);
           $Total_Pagado=$f_ordenes['pagado'];
			 
			 
			 $orden_pago=$num.'-'.$op_saf.'-'.$orden;
	  
	  
	   
	   if($estado=='B'){$est='BLOQUEADA';}
	   if($estado=='A'){$est='BAJA';}
	   if($estado=='P'){$est='';}
	   if($estado=='I'){$est='IMPUESTOS';}
	  
	   
	$pdf->SetFont('courier',$negra,8);
	$pdf->SetY($y_axis);
	$pdf->SetX(15);
	$cont=$cont+1;
    $pdf->Cell(10,6,$cont,1,0,'C',1); 
	$pdf->Cell(20,6,$orden_pago,1,0,'C',1);
	$pdf->SetFont('courier',$negra,6);
    $pdf->Cell(65,6,$benef,1,0,'L',1);
	$pdf->Cell(65,6,$concepto,1,0,'L',1);
	$pdf->SetFont('courier',$negra,8);
	$pdf->Cell(25,6,$Total_Pagado,1,0,'R',1);
	$pdf->Cell(25,6,$Imp_orden,1,0,'R',1);
	$pdf->Cell(25,6,$IMP3,1,0,'R',1);
	
	$pdf->Cell(30,6,$est,1,0,'R',1);
	
	
	
	
  //  $pdf->Cell(35,6,$concepto,1,0,'L',1);
	
	
	
    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
}





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
			$pdf->cell(0,0,'LISTADO DE ORDENES DE PAGO PENDIENTES  '.$fecha_cons.' - '.'SAF '.$saf,0,'B','C',0);
			
			
			$y_axis_initial = 55;
			$p=$y_axis_initial;
			$pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','IB',10);
			$pdf->SetY($p+7);
			$pdf->SetX(45);
			$pdf->Cell(10,7,'TOTALES',0,0,'C',1);
			$pdf->SetFont('Arial','B',10);
			$pdf->SetX(45);
			$pdf->SetY($p+14);
		    $pdf->Cell(25,7,'Saldos Disp',0,0,'C',1);
			$pdf->Cell(60,7,'$ '.number_format($saldo,2),0,0,'R',1);

			$pdf->SetY($p+21);
			$pdf->Cell(25,7,'Imp. Form',0,0,'C',1);
			$pdf->Cell(60,7,'$ '.number_format($importe,2),0,0,'R',1);
			$pdf->SetY($p+28);
			$pdf->Cell(25,7,'Imp. Pagado',0,0,'C',1);
			$pdf->Cell(60,7,'$ '.number_format($total,2),0,0,'R',1);
			


///////////////////
$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');


$pdf->AliasNbPages();


 $_pagi_sql = "SELECT orden_pago.* , (
IMP_FORM - RETENCION - IMPORTE_A_PAGAR
) AS pagado, (
IMP_FORM - RETENCION
) AS Imp_orden, e.ESCRITURAL,e.DENOMINACION,e.ID
FROM orden_pago, escritural AS e
WHERE EJERCICIO = '$fecha_cons'
AND orden_pago.SAF='$saf'
AND e.ID = orden_pago.id_escritural
AND e.ESTADO='A'
AND orden_pago.ESTADO = 'B'
ORDER BY FECHA_OP desc,FORMULARIO,ESCRITURAL,NUMERO ";
							  
		
			 if (!($ordenes= mysql_query($_pagi_sql, $conexion_mysql)))
			{
			
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes";
			  echo $cuerpo1;
			  //.....................................................................
			}  
			
						  
			$ssql = "SELECT SUM( IMPORTE_A_PAGAR ) AS saldo, SUM( IMP_FORM - RETENCION - IMPORTE_A_PAGAR ) AS total, SUM( IMP_FORM - RETENCION ) AS importe, count(NUMERO) AS cant
						FROM orden_pago,escritural AS e 
						WHERE EJERCICIO='$fecha_cons' 
						AND orden_pago.SAF='$saf'
						AND e.ID = orden_pago.id_escritural
						AND orden_pago.ESTADO ='B'
						AND e.ESTADO='A' ";
				 if (!($r_op= mysql_query($ssql, $conexion_mysql)))
				{
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar area";
				 
				  //.....................................................................
				}
  
	$f_orden=mysql_fetch_array($r_op);
    $saldo=$f_orden['saldo'];	
    $importe=$f_orden['importe'];
    $total=$f_orden['total'];


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
$pdf->cell(0,0,'LISTADO DE ORDENES DE PAGO - BLOQUEADAS -  '.$fecha_cons.' - '.'SAF '.$saf,0,'B','C',0);


$y_axis_initial = 55;

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',6);
$pdf->SetY($y_axis_initial);
$pdf->SetX(15);
$pdf->Cell(10,7,'Nº',1,0,'C',1);
$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
$pdf->Cell(65,7,'Beneficiarios',1,0,'C',1);
$pdf->Cell(65,7,'Concepto',1,0,'C',1);
$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);
$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
$pdf->Cell(30,7,'Estado',1,0,'C',1);








$i = 0;

//Set maximum rows per page
$max = 20;
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
			$pdf->cell(0,0,'LISTADO DE ORDENES DE PAGO - BLOQUEADAS - '.$fecha_cons.' - '.'SAF '.$saf,0,'B','C',0);
			
			
			$y_axis_initial = 55;
			
			$pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',6);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(15);
			$pdf->Cell(10,7,'Nº',1,0,'C',1);
			$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
			$pdf->Cell(65,7,'Beneficiarios',1,0,'C',1);
			$pdf->Cell(65,7,'Concepto',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);
			$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
			$pdf->Cell(30,7,'Estado',1,0,'C',1);
						
			$i = 0;
			
			//Set maximum rows per page
			$max = 20;
			$y_axis=62;
			//Set Row Height
			$row_height = 7;
			

        //Set $i variable to 0 (first row)
        
    }

       $fecha=$f_ordenes['Fecha_OP'];
       $saf=$f_ordenes['Saf'];
      // $orden_pago=$f_ordenes['Numero_OP'];
	  // $sal_disp=$f_ordenes['Saldos'];
	  // $imp_form=$f_ordenes['Imp_orden'];
	  // $imp_pag=$f_ordenes['Total_Pagado'];
	   $benef=substr($f_ordenes['BENEFICIARIO'],0,40);
	   $concepto=substr($f_ordenes['CONCEPTO'],0,40);
	     $estado=$f_ordenes['ESTADO'];
	 //  $concepto=substr($f_ordenes['Concepto'],0,15);
	  
	       $d_cuit=$f_ordenes['CUIT'];
		   $orden=$f_ordenes['NUMERO'];
		   $op_saf=$f_ordenes['SAF'];
		   $ejer_op=$f_ordenes['EJERCICIO'];
		   $num=$f_ordenes['FORMULARIO']; 
		  
		   $IMP1= number_format($f_ordenes['IMP_FORM'],2);
		   $IMP2=number_format($f_ordenes['RETENCION'],2);
		   $IMP3=number_format($f_ordenes['IMPORTE_A_PAGAR'],2);
		   $Imp_orden=number_format($f_ordenes['Imp_orden'],2);
           $Total_Pagado=$f_ordenes['pagado'];
			 
			 
			 $orden_pago=$num.'-'.$op_saf.'-'.$orden;
	  
	  
	   
	   if($estado=='B'){$est='BLOQUEADA';}
	   if($estado=='A'){$est='BAJA';}
	   if($estado=='P'){$est='';}
	   if($estado=='I'){$est='IMPUESTOS';}
	  
	   
	$pdf->SetFont('courier',$negra,8);
	$pdf->SetY($y_axis);
	$pdf->SetX(15);
	$cont=$cont+1;
    $pdf->Cell(10,6,$cont,1,0,'C',1); 
	$pdf->Cell(20,6,$orden_pago,1,0,'C',1);
	$pdf->SetFont('courier',$negra,6);
    $pdf->Cell(65,6,$benef,1,0,'L',1);
	$pdf->Cell(65,6,$concepto,1,0,'L',1);
	$pdf->SetFont('courier',$negra,8);
	$pdf->Cell(25,6,$Total_Pagado,1,0,'R',1);
	$pdf->Cell(25,6,$Imp_orden,1,0,'R',1);
	$pdf->Cell(25,6,$IMP3,1,0,'R',1);
	
	$pdf->Cell(30,6,$est,1,0,'R',1);
	
	
	
	
  //  $pdf->Cell(35,6,$concepto,1,0,'L',1);
	
	
	
    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
}





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
			$pdf->cell(0,0,'LISTADO DE ORDENES DE PAGO - BLOQUEADAS -   '.$fecha_cons.' - '.'SAF '.$saf,0,'B','C',0);
			
			
			$y_axis_initial = 55;
			$p=$y_axis_initial;
			$pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','IB',10);
			$pdf->SetY($p+7);
			$pdf->SetX(45);
			$pdf->Cell(10,7,'TOTALES',0,0,'C',1);
			$pdf->SetFont('Arial','B',10);
			$pdf->SetX(45);
			$pdf->SetY($p+14);
		    $pdf->Cell(25,7,'Saldos Disp',0,0,'C',1);
			$pdf->Cell(60,7,'$ '.number_format($saldo,2),0,0,'R',1);

			$pdf->SetY($p+21);
			$pdf->Cell(25,7,'Imp. Form',0,0,'C',1);
			$pdf->Cell(60,7,'$ '.number_format($importe,2),0,0,'R',1);
			$pdf->SetY($p+28);
			$pdf->Cell(25,7,'Imp. Pagado',0,0,'C',1);
			$pdf->Cell(60,7,'$ '.number_format($total,2),0,0,'R',1);
			


///////////////////
$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');


$pdf->AliasNbPages();



 $_pagi_sql = "SELECT orden_pago.* , (
IMP_FORM - RETENCION - IMPORTE_A_PAGAR
) AS pagado, (
IMP_FORM - RETENCION
) AS Imp_orden, e.ESCRITURAL,e.DENOMINACION,e.ID
FROM orden_pago, escritural AS e
WHERE EJERCICIO = '$fecha_cons'
AND orden_pago.SAF='$saf'
AND e.ID = orden_pago.id_escritural
AND e.ESTADO='A'
AND orden_pago.ESTADO = 'B'
ORDER BY FECHA_OP desc,FORMULARIO,ESCRITURAL,NUMERO ";
							  
		
			 if (!($ordenes= mysql_query($_pagi_sql, $conexion_mysql)))
			{
			
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes";
			  echo $cuerpo1;
			  //.....................................................................
			}  
			
						  
			$ssql = "SELECT SUM( IMPORTE_A_PAGAR ) AS saldo, SUM( IMP_FORM - RETENCION - IMPORTE_A_PAGAR ) AS total, SUM( IMP_FORM - RETENCION ) AS importe, count(NUMERO) AS cant
						FROM orden_pago,escritural AS e 
						WHERE EJERCICIO='$fecha_cons' 
						AND orden_pago.SAF='$saf'
						AND e.ID = orden_pago.id_escritural
						AND orden_pago.ESTADO ='B'
						AND e.ESTADO='A' ";
				 if (!($r_op= mysql_query($ssql, $conexion_mysql)))
				{
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar area";
				 
				  //.....................................................................
				}
  
	$f_orden=mysql_fetch_array($r_op);
    $saldo=$f_orden['saldo'];	
    $importe=$f_orden['importe'];
    $total=$f_orden['total'];


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
$pdf->cell(0,0,'LISTADO DE ORDENES DE PAGO - BAJAS -  '.$fecha_cons.' - '.'SAF '.$saf,0,'B','C',0);


$y_axis_initial = 55;

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',6);
$pdf->SetY($y_axis_initial);
$pdf->SetX(15);
$pdf->Cell(10,7,'Nº',1,0,'C',1);
$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
$pdf->Cell(65,7,'Beneficiarios',1,0,'C',1);
$pdf->Cell(65,7,'Concepto',1,0,'C',1);
$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);
$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
$pdf->Cell(30,7,'Estado',1,0,'C',1);








$i = 0;

//Set maximum rows per page
$max = 20;
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
			$pdf->cell(0,0,'LISTADO DE ORDENES DE PAGO -BAJA-  '.$fecha_cons.' - '.'SAF '.$saf,0,'B','C',0);
			
			
			$y_axis_initial = 55;
			
			$pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',6);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(15);
			$pdf->Cell(10,7,'Nº',1,0,'C',1);
			$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
			$pdf->Cell(65,7,'Beneficiarios',1,0,'C',1);
			$pdf->Cell(65,7,'Concepto',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);
			$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
			$pdf->Cell(30,7,'Estado',1,0,'C',1);
						
			$i = 0;
			
			//Set maximum rows per page
			$max = 20;
			$y_axis=62;
			//Set Row Height
			$row_height = 7;
			

        //Set $i variable to 0 (first row)
        
    }

       $fecha=$f_ordenes['Fecha_OP'];
       $saf=$f_ordenes['Saf'];
      // $orden_pago=$f_ordenes['Numero_OP'];
	  // $sal_disp=$f_ordenes['Saldos'];
	  // $imp_form=$f_ordenes['Imp_orden'];
	  // $imp_pag=$f_ordenes['Total_Pagado'];
	   $benef=substr($f_ordenes['BENEFICIARIO'],0,40);
	   $concepto=substr($f_ordenes['CONCEPTO'],0,40);
	     $estado=$f_ordenes['ESTADO'];
	 //  $concepto=substr($f_ordenes['Concepto'],0,15);
	  
	       $d_cuit=$f_ordenes['CUIT'];
		   $orden=$f_ordenes['NUMERO'];
		   $op_saf=$f_ordenes['SAF'];
		   $ejer_op=$f_ordenes['EJERCICIO'];
		   $num=$f_ordenes['FORMULARIO']; 
		  
		   $IMP1= number_format($f_ordenes['IMP_FORM'],2);
		   $IMP2=number_format($f_ordenes['RETENCION'],2);
		   $IMP3=number_format($f_ordenes['IMPORTE_A_PAGAR'],2);
		   $Imp_orden=number_format($f_ordenes['Imp_orden'],2);
           $Total_Pagado=$f_ordenes['pagado'];
			 
			 
			 $orden_pago=$num.'-'.$op_saf.'-'.$orden;
	  
	  
	   
	   if($estado=='B'){$est='BLOQUEADA';}
	   if($estado=='A'){$est='BAJA';}
	   if($estado=='P'){$est='';}
	   if($estado=='I'){$est='IMPUESTOS';}
	  
	   
	$pdf->SetFont('courier',$negra,8);
	$pdf->SetY($y_axis);
	$pdf->SetX(15);
	$cont=$cont+1;
    $pdf->Cell(10,6,$cont,1,0,'C',1); 
	$pdf->Cell(20,6,$orden_pago,1,0,'C',1);
	$pdf->SetFont('courier',$negra,6);
    $pdf->Cell(65,6,$benef,1,0,'L',1);
	$pdf->Cell(65,6,$concepto,1,0,'L',1);
	$pdf->SetFont('courier',$negra,8);
	$pdf->Cell(25,6,$Total_Pagado,1,0,'R',1);
	$pdf->Cell(25,6,$Imp_orden,1,0,'R',1);
	$pdf->Cell(25,6,$IMP3,1,0,'R',1);
	
	$pdf->Cell(30,6,$est,1,0,'R',1);
	
	
	
	
  //  $pdf->Cell(35,6,$concepto,1,0,'L',1);
	
	
	
    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
}





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
			$pdf->cell(0,0,'LISTADO DE ORDENES DE PAGO - BAJA -  '.$fecha_cons.' - '.'SAF '.$saf,0,'B','C',0);
			
			
			$y_axis_initial = 55;
			$p=$y_axis_initial;
			$pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','IB',10);
			$pdf->SetY($p+7);
			$pdf->SetX(45);
			$pdf->Cell(10,7,'TOTALES',0,0,'C',1);
			$pdf->SetFont('Arial','B',10);
			$pdf->SetX(45);
			$pdf->SetY($p+14);
		    $pdf->Cell(25,7,'Saldos Disp',0,0,'C',1);
			$pdf->Cell(60,7,'$ '.number_format($saldo,2),0,0,'R',1);

			$pdf->SetY($p+21);
			$pdf->Cell(25,7,'Imp. Form',0,0,'C',1);
			$pdf->Cell(60,7,'$ '.number_format($importe,2),0,0,'R',1);
			$pdf->SetY($p+28);
			$pdf->Cell(25,7,'Imp. Pagado',0,0,'C',1);
			$pdf->Cell(60,7,'$ '.number_format($total,2),0,0,'R',1);
			


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
