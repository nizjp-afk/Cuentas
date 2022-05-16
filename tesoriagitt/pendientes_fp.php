<?php
 error_reporting ( E_ERROR );
   //conexion
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	$bandera = $_GET['band'];
	$fecha_cons=$_GET['fecha_cons'];
	//escritural
	$id=$_GET['saf'];
	
	include('incluir_siempre.php');
	  
    include('../dgti-mysql-var_dbtgp.php');
    include('../dgti-intranet-mysql_connect.php');  
	include('../dgti-intranet-mysql_select_db.php');

/*SELECT orden_pago . * , (
IMP_FORM - RETENCION - IMPORTE_A_PAGAR
) AS pagado, (
IMP_FORM - RETENCION
) AS Imp_orden, ESCRITURAL.escritural, ESCRITURAL.DENOMINACION
FROM orden_pago, escritural
WHERE EJERCICIO = '$fecha_cons'
AND orden_pago.ESTADO = 'P'
AND ID = id_escritural
ORDER BY `escritural`.`ESCRITURAL` ASC

*/
if ($id=='')
  {
	   $ssql = "SELECT orden_pago.* , (
IMP_FORM - RETENCION - IMPORTE_A_PAGAR
) AS pagado, (
IMP_FORM - RETENCION
) AS Imp_orden, e.ESCRITURAL,e.DENOMINACION,e.ID,b.inhi
FROM orden_pago, escritural AS e,beneficiarios_aprobados AS b
WHERE EJERCICIO = '$fecha_cons'
AND e.ID = orden_pago.id_escritural
AND e.ESTADO='A'
AND orden_pago.ESTADO = 'P'
AND orden_pago.CUIT=b.cuitl
AND b.estado='A'
AND (b.inhi='' or  b.inhi='Cesion')
ORDER BY e.ESCRITURAL ASC,FORMULARIO,NUMERO ASC"; 

  }
  else
  {

	 $ssql = "SELECT orden_pago.* , (
IMP_FORM - RETENCION - IMPORTE_A_PAGAR
) AS pagado, (
IMP_FORM - RETENCION
) AS Imp_orden, e.ESCRITURAL,e.DENOMINACION,e.ID,b.inhi
FROM orden_pago, escritural AS e,beneficiarios_aprobados AS b
WHERE EJERCICIO = '$fecha_cons'
AND e.ID = orden_pago.id_escritural
AND e.ESTADO='A'
AND orden_pago.ESTADO = 'P'
AND orden_pago.CUIT=b.cuitl
AND e.ID = '$id'
AND b.estado='A'
AND (b.inhi='' or  b.inhi='Cesion')
ORDER BY e.ESCRITURAL ASC,FORMULARIO,NUMERO ASC";
	 
	 
	 
	 
/*	 "SELECT orden_pago . * , (
IMP_FORM - RETENCION - IMPORTE_A_PAGAR
) AS pagado, (
IMP_FORM - RETENCION
) AS Imp_orden, ESCRITURAL.escritural, ESCRITURAL.DENOMINACION
FROM orden_pago, escritural
WHERE EJERCICIO = '$fecha_cons'
AND orden_pago.ESTADO = 'P'
AND escritural.ID = '$id'
AND ID = id_escritural
ORDER BY FECHA_OP DESC , FORMULARIO, orden_pago.SAF, NUMERO
"; */
  }
if (!($r_op= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
	if ($id=='')
  {
  

$ssqli ="SELECT orden_pago . * , (
IMP_FORM - RETENCION - IMPORTE_A_PAGAR
) AS pagado, (
IMP_FORM - RETENCION
) AS Imp_orden, e.ESCRITURAL, e.DENOMINACION, e.ID,b.inhi
FROM orden_pago, escritural AS e, beneficiarios_aprobados b
WHERE EJERCICIO = '$fecha_cons'
AND e.ID = orden_pago.id_escritural
AND e.ESTADO = 'A'
AND orden_pago.ESTADO = 'P'
AND orden_pago.CUIT = b.cuitl
AND (b.estado = 'A' or b.estado = 'B')
AND (b.inhi!='' and  b.inhi!='Cesion')
ORDER BY `e`.`ESCRITURAL` ASC , FORMULARIO, NUMERO ASC";
  }
 else
  {
	 $ssqli ="SELECT orden_pago . * , (
IMP_FORM - RETENCION - IMPORTE_A_PAGAR
) AS pagado, (
IMP_FORM - RETENCION
) AS Imp_orden, e.ESCRITURAL, e.DENOMINACION, e.ID,b.inhi
FROM orden_pago, escritural AS e, beneficiarios_aprobados b
WHERE EJERCICIO = '$fecha_cons'
AND e.ID = orden_pago.id_escritural
AND e.ESTADO = 'A'
AND orden_pago.ESTADO = 'P'
AND orden_pago.CUIT = b.cuitl
AND e.ID = '$id'
AND (b.estado = 'A' or b.estado = 'B')
AND (b.inhi!='' and  b.inhi!='Cesion')
ORDER BY `e`.`ESCRITURAL` ASC , FORMULARIO, NUMERO ASC";
 
  }

if (!($r_op_i= mysql_query($ssqli, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
	
	
	
//////////////fin de consulta en base///////////
  
   $max=30;
   $f=strftime("%Y-%m-%d");
   $dia = date("d/m/Y");
   $hora =date("h:i");

//echo "paso";exit; 		
define('FPDF_FONTPATH','font/');
require('../fpdf.php');

//Connect to your database
//Create new pdf file
$pdf=new FPDF('P','mm','A4');
//$pdf=new FPDF('P','mm','A4'); // imprime hoja horizontal
//$pdf=new FPDF('P','mm','Legal');//imprime hoja vertical
  
    $tot_importe=0;
	$tot_pagado=0;
	$tot_saldo=0;
	$tot_auto=0;
	$tot_nuevo_sal=0;
	$tot_gral_importe=0;
	$tot_gral_pagado=0;
	$tot_gral_saldo=0;
	$tot_gral_auto=0;
	$tot_gral_nuevo_sal=0;
//Open file
$pdf->Open();
$cp=0;

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage();

$y_axis_initial = 17;
// imprime el titulo de la pagina
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($y_axis_initial);
$pdf->Image('../img/tgp_01.jpg',30,6,25);
//$pdf->Image('../img/tgp_02.jpg',75,6,10);

$pdf->SetFont('Arial','B',6);
//$pdf->setX(150);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
//$pdf->setY(25);
$pdf->SetY(15);
$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
$pdf->SetY($y_axis_initial+4);
$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);
$pdf->SetY($y_axis_initial+8);
$pdf->SetFont('Arial','B',6);
//$pdf->cell(0,0,'Nº Autorizacion: '.$nro,0,'B','R',0);
///$pdf->SetY($y_axis_initial+12);

$pdf->Cell(0,0,'Pagina: '.$pdf->PageNo().'/{nb}',0,'B','R',0);
$pdf->AliasNbPages();
//Launch the print dialog
//$pdf->AutoPrint(true);

//set initial y axis position per page
$y_axis_initial = 30;
$pdf->SetY($y_axis_initial);
$pdf->SetFont('Arial','B',10);
$pdf->SetX(5);
$pdf->cell(0,0,'EJERCICIO: '.$fecha_cons ,0,'B','L',0);
$pdf->SetX(50);
$pdf->Cell(0,0,'NUEVAS ORDENES DE PAGOS PENDIENTE DE CANCELACION
','0',0,'L',0);

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',10);
$i=35;
$pdf->SetY($i);
$pdf->SetX(5);
$pdf->Cell(0,4,'','T',0,'L',1);


///////////////////////////////////////////////////////////////////////////////////////

////// DETALLE DEL PRESUPUESTO

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','UB',5);
$pdf->SetY($i=$i+7);
$pdf->SetX(0);
$pdf->Cell(30,6,'Escritural',0,0,'C',0);
$pdf->Cell(25,6,'Formul',0,0,'C',0);
$pdf->Cell(10,6,'Fuente',0,0,'C',0);
$pdf->Cell(10,6,'Clase',0,0,'C',0);
$pdf->Cell(35,6,'Beneficiario',0,0,'C',0);
$pdf->Cell(35,6,'Concepto',0,0,'C',0);
$pdf->Cell(20,6,'Imp. del Form',0,0,'C',0);
$pdf->Cell(20,6,'Pagado',0,0,'C',0);
$pdf->Cell(20,6,'Saldo',0,0,'C',0);

$aux=='0';
$pdf->SetY($i=$i+2);
//$y_axis=54;
$row_height = 7;
$InterLigne = 4;

while($row = mysql_fetch_array($r_op))
{
	$esc=$row['ESCRITURAL']; 
	if($aux==0)
	  {
		$aux=$esc;  
	  }
 if($aux==$esc)
   {		
		  	
  if ($max==$cp)
    {
	 	$pdf->AddPage();

		$y_axis_initial = 17;
		// imprime el titulo de la pagina
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',8);
		$pdf->SetY($y_axis_initial);
		$pdf->Image('../img/tgp_01.jpg',30,6,25);
//$pdf->Image('../img/tgp_02.jpg',75,6,10);

$pdf->SetFont('Arial','B',6);
//$pdf->setX(150);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
//$pdf->setY(25);
$pdf->SetY(15);
$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
$pdf->SetY($y_axis_initial+4);
$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);
$pdf->SetY($y_axis_initial+8);
$pdf->SetFont('Arial','B',6);
//$pdf->cell(0,0,'Nº Autorizacion: '.$nro,0,'B','R',0);
///$pdf->SetY($y_axis_initial+12);

$pdf->Cell(0,0,'Pagina: '.$pdf->PageNo().'/{nb}',0,'B','R',0);
$pdf->AliasNbPages();
//Launch the print dialog
//$pdf->AutoPrint(true);

//set initial y axis position per page
$y_axis_initial = 30;
$pdf->SetY($y_axis_initial);
$pdf->SetFont('Arial','B',12);
$pdf->SetX(5);
$pdf->cell(0,0,'EJERCICIO: '.$fecha_cons ,0,'B','L',0);
$pdf->SetX(50);
$pdf->Cell(0,0,'NUEVAS ORDENES DE PAGOS PENDIENTE DE CANCELACION
','0',0,'L',0);

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',10);
$i=35;
$pdf->SetY($i);
$pdf->SetX(5);
$pdf->Cell(0,4,'','T',0,'L',1);


///////////////////////////////////////////////////////////////////////////////////////

////// DETALLE DEL PRESUPUESTO

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','UB',5);
$pdf->SetY($i=$i+7);
$pdf->SetX(0);
$pdf->Cell(30,6,'Escritural',0,0,'C',0);
$pdf->Cell(25,6,'Formul',0,0,'C',0);
$pdf->Cell(10,6,'Fuente',0,0,'C',0);
$pdf->Cell(10,6,'Clase',0,0,'C',0);
$pdf->Cell(35,6,'Beneficiario',0,0,'C',0);
$pdf->Cell(35,6,'Concepto',0,0,'C',0);
$pdf->Cell(20,6,'Imp. del Form',0,0,'C',0);
$pdf->Cell(20,6,'Pagado',0,0,'C',0);
$pdf->Cell(20,6,'Saldo',0,0,'C',0);

//$aux=='';
$pdf->SetY($i=$i+2);
$cp=0;
		//$y_axis=54;
		$row_height = 7;
		$InterLigne = 4;
	}
  
  //If the current row is the last one, create new page and print column title
    
	       $saf = $row['SAF'];
	   
	       $d_cuit=$row['CUIT'];
		   $beneficiario = $row['BENEFICIARIO'];
		    $concepto = $row['CONCEPTO'];
		   $fuente = $row['FUENTE'];
		   $clase = $row['CLASE'];
		  // $estado_op=$f_orden['ESTADO'];
		   $orden=$row['NUMERO'];
		   $num=$row['FORMULARIO']; 
		   
		   $IMP1= number_format($row['IMP_FORM'],2);
		   $IMP2=number_format($row['RETENCION'],2);
		   $IMP3=number_format($row['IMPORTE_A_PAGAR'],2);
		   $Imp_orden=number_format($row['Imp_orden'],2);
           $Total_Pagado=number_format($row['pagado'],2);
			 
			//$esc=$row['ESCRITURAL']; 
			$den=$row['DENOMINACION'];
			  
			 $orden1=$num.'-'.$saf.'-'.$orden;
		   
		  /*$formul = $row['Numero_OP'];
		  $fuente = $row['Fuente'];
		  $clase = $row['Clase'];
		  
		  $concepto = $row['Concepto'];
		  $importe = $row['Imp_orden'];
		  $pagado = $row['Total_Pagado'];
		  $saldo = $row['Saldos'];
		  $autorizado = $row['autorizado'];*/
		  
		//  $nuevo_saldo=$saldo-$autorizado;
		  
		  $tot_importe=$tot_importe+$row['Imp_orden'];
		  
		  $tot_pagado=$tot_pagado+$row['pagado'];
		  
		  $tot_saldo=$tot_saldo+$row['IMPORTE_A_PAGAR'];
		  
		
    
   
   
		$pdf->SetFont('courier','',6);
		$pdf->SetY($i=$i+3);
		$pdf->SetX(0);
        $pdf->Cell(30,5,$esc,0,0,'C',1);
		$pdf->Cell(25,5,$orden1,0,0,'C',1);
		$pdf->Cell(10,5,$fuente,0,0,'C',1);
		$pdf->Cell(10,5,$clase,0,0,'C',1);
		//$pdf->SetFont('courier','',6);
		$pdf->Cell(35,5,$beneficiario,0,0,'L',1);
		$pdf->Cell(35,5,substr($concepto,5,25),0,0,'L',1);
		$pdf->SetFont('courier','',6);
		$pdf->Cell(20,5,$Imp_orden,0,0,'R',1);
		$pdf->Cell(20,5,$Total_Pagado,0,0,'R',1);
		$pdf->Cell(20,5,$IMP3,0,0,'R',1);
     
	 	$pdf->SetY($i=$i+5);
        $pdf->SetX(5);
        $pdf->Cell(200,4,'','T',0,'L',1);
 
	//$pdf->line(15,$y_axis,205,$y_axis); 
        $cp=$cp+1; 
	    $y_axis = $y_axis + $row_height;
		
	}
else
  {	
  $aux=$esc;
     if (($max==$cp) or ($cp==25))
    {
				$pdf->AddPage();
		
				$y_axis_initial = 17;
				// imprime el titulo de la pagina
				$pdf->SetFillColor(256,256,256);
				$pdf->SetFont('Arial','B',8);
				$pdf->SetY($y_axis_initial);
				$pdf->Image('../img/tgp_01.jpg',30,6,25);
		//$pdf->Image('../img/tgp_02.jpg',75,6,10);
		
		$pdf->SetFont('Arial','B',6);
		//$pdf->setX(150);
		// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
		//$pdf->setY(25);
		$pdf->SetY(15);
		$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
		$pdf->SetY($y_axis_initial+4);
		$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);
		$pdf->SetY($y_axis_initial+8);
		$pdf->SetFont('Arial','B',6);
		//$pdf->cell(0,0,'Nº Autorizacion: '.$nro,0,'B','R',0);
		///$pdf->SetY($y_axis_initial+12);
		
		$pdf->Cell(0,0,'Pagina: '.$pdf->PageNo().'/{nb}',0,'B','R',0);
		$pdf->AliasNbPages();
		//Launch the print dialog
		//$pdf->AutoPrint(true);
		
		//set initial y axis position per page
		$y_axis_initial = 30;
		$pdf->SetY($y_axis_initial);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetX(5);
		$pdf->cell(0,0,'EJERCICIO: '.$fecha_cons ,0,'B','L',0);
		$pdf->SetX(50);
		$pdf->Cell(0,0,'NUEVAS ORDENES DE PAGOS PENDIENTE DE CANCELACION
		','0',0,'L',0);
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',10);
		$i=35;
		$pdf->SetY($i);
		$pdf->SetX(5);
		$pdf->Cell(0,4,'','T',0,'L',1);
		
		
		///////////////////////////////////////////////////////////////////////////////////////
		
		////// DETALLE DEL PRESUPUESTO
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','UB',5);
		$pdf->SetY($i=$i+7);
		$pdf->SetX(0);
		$pdf->Cell(30,6,'Escritural',0,0,'C',0);
		$pdf->Cell(25,6,'Formul',0,0,'C',0);
		$pdf->Cell(10,6,'Fuente',0,0,'C',0);
		$pdf->Cell(10,6,'Clase',0,0,'C',0);
		$pdf->Cell(35,6,'Beneficiario',0,0,'C',0);
		$pdf->Cell(35,6,'Concepto',0,0,'C',0);
		$pdf->Cell(20,6,'Imp. del Form',0,0,'C',0);
		$pdf->Cell(20,6,'Pagado',0,0,'C',0);
		$pdf->Cell(20,6,'Saldo',0,0,'C',0);
		
		//$aux=='';
		$pdf->SetY($i=$i+2);
		$cp=0;
				//$y_axis=54;
				$row_height = 7;
				$InterLigne = 4;
	}
  
        $pdf->SetFont('courier','B',6);
        $pdf->SetFillColor(256,256,256);
		$pdf->SetY($i=$i+2);
		$pdf->SetX(0);   
		//$pdf->Cell(60,6,'TOTAL DEL SERVICIO :'.$esc,1,0,'L',1);
		$pdf->Cell(165,6,number_format($tot_importe,2),0,0,'R',1);
		$pdf->Cell(20,6,number_format($tot_pagado,2),0,0,'R',1);
		$pdf->Cell(20,6,number_format($tot_saldo,2),0,0,'R',1);
		$pdf->SetY($i=$i+5);
        $pdf->SetX(5);
        $pdf->Cell(200,4,'','T',0,'L',1);
		
  	    $tot_gral_importe=$tot_gral_importe+$tot_importe;
	    $tot_gral_pagado=$tot_gral_pagado+$tot_pagado;
	    $tot_gral_saldo=$tot_gral_saldo+$tot_saldo;
		$tot_importe=0;
	    $tot_pagado=0;
	    $tot_saldo=0;
		  
	  $saf = $row['SAF'];
	   
	       $d_cuit=$row['CUIT'];
		   $beneficiario = $row['BENEFICIARIO'];
		    $concepto = $row['CONCEPTO'];
		   $fuente = $row['FUENTE'];
		   $clase = $row['CLASE'];
		  // $estado_op=$f_orden['ESTADO'];
		   $orden=$row['NUMERO'];
		   $num=$row['FORMULARIO']; 
		   
		   $IMP1= number_format($row['IMP_FORM'],2);
		   $IMP2=number_format($row['RETENCION'],2);
		   $IMP3=number_format($row['IMPORTE_A_PAGAR'],2);
		   $Imp_orden=number_format($row['Imp_orden'],2);
           $Total_Pagado=number_format($row['pagado'],2);
			 
		//	$esc=$row['escritural']; 
			$den=$row['DENOMINACION'];
			  
			 $orden1=$num.'-'.$saf.'-'.$orden;
		   
		  /*$formul = $row['Numero_OP'];
		  $fuente = $row['Fuente'];
		  $clase = $row['Clase'];
		  
		  $concepto = $row['Concepto'];
		  $importe = $row['Imp_orden'];
		  $pagado = $row['Total_Pagado'];
		  $saldo = $row['Saldos'];
		  $autorizado = $row['autorizado'];*/
		  
		//  $nuevo_saldo=$saldo-$autorizado;
		  
		  $tot_importe=$tot_importe+$row['Imp_orden'];
		  
		  $tot_pagado=$tot_pagado+$row['pagado'];
		  
		  $tot_saldo=$tot_saldo+$row['IMPORTE_A_PAGAR'];
		  
		
    
 if($cp > 25)
      {
				$pdf->AddPage();
		
				$y_axis_initial = 17;
				// imprime el titulo de la pagina
				$pdf->SetFillColor(256,256,256);
				$pdf->SetFont('Arial','B',8);
				$pdf->SetY($y_axis_initial);
				$pdf->Image('../img/tgp_01.jpg',30,6,25);
		//$pdf->Image('../img/tgp_02.jpg',75,6,10);
		
		$pdf->SetFont('Arial','B',6);
		//$pdf->setX(150);
		// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
		//$pdf->setY(25);
		$pdf->SetY(15);
		$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
		$pdf->SetY($y_axis_initial+4);
		$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);
		$pdf->SetY($y_axis_initial+8);
		$pdf->SetFont('Arial','B',6);
		//$pdf->cell(0,0,'Nº Autorizacion: '.$nro,0,'B','R',0);
		///$pdf->SetY($y_axis_initial+12);
		
		$pdf->Cell(0,0,'Pagina: '.$pdf->PageNo().'/{nb}',0,'B','R',0);
		$pdf->AliasNbPages();
		//Launch the print dialog
		//$pdf->AutoPrint(true);
		
		//set initial y axis position per page
		$y_axis_initial = 30;
		$pdf->SetY($y_axis_initial);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetX(5);
		$pdf->cell(0,0,'EJERCICIO: '.$fecha_cons ,0,'B','L',0);
		$pdf->SetX(50);
		$pdf->Cell(0,0,'NUEVAS ORDENES DE PAGOS PENDIENTE DE CANCELACION
		','0',0,'L',0);
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',10);
		$i=35;
		$pdf->SetY($i);
		$pdf->SetX(5);
		$pdf->Cell(0,4,'','T',0,'L',1);
		
		
		///////////////////////////////////////////////////////////////////////////////////////
		
		////// DETALLE DEL PRESUPUESTO
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','UB',5);
		$pdf->SetY($i=$i+7);
		$pdf->SetX(0);
		$pdf->Cell(30,6,'Escritural',0,0,'C',0);
		$pdf->Cell(25,6,'Formul',0,0,'C',0);
		$pdf->Cell(10,6,'Fuente',0,0,'C',0);
		$pdf->Cell(10,6,'Clase',0,0,'C',0);
		$pdf->Cell(35,6,'Beneficiario',0,0,'C',0);
		$pdf->Cell(35,6,'Concepto',0,0,'C',0);
		$pdf->Cell(20,6,'Imp. del Form',0,0,'C',0);
		$pdf->Cell(20,6,'Pagado',0,0,'C',0);
		$pdf->Cell(20,6,'Saldo',0,0,'C',0);
		
		//$aux=='';
		$pdf->SetY($i=$i+2);
		$cp=0;
				//$y_axis=54;
				$row_height = 7;
				$InterLigne = 4;
	  }
   
		$pdf->SetFont('courier','',6);
		$pdf->SetY($i=$i+3);
		$pdf->SetX(0);
        $pdf->Cell(30,5,$esc,0,0,'C',1);
		$pdf->Cell(25,5,$orden1,0,0,'C',1);
		$pdf->Cell(10,5,$fuente,0,0,'C',1);
		$pdf->Cell(10,5,$clase,0,0,'C',1);
		//$pdf->SetFont('courier','',6);
		$pdf->Cell(35,5,$beneficiario,0,0,'L',1);
		$pdf->Cell(35,5,substr($concepto,5,25),0,0,'L',1);
		$pdf->SetFont('courier','',6);
		$pdf->Cell(20,5,$Imp_orden,0,0,'R',1);
		$pdf->Cell(20,5,$Total_Pagado,0,0,'R',1);
		$pdf->Cell(20,5,$IMP3,0,0,'R',1);
     
	 	$pdf->SetY($i=$i+5);
        $pdf->SetX(5);
        $pdf->Cell(200,4,'','T',0,'L',1);
 
	//$pdf->line(15,$y_axis,205,$y_axis); 
        $cp=$cp+1; 
	    $y_axis = $y_axis + $row_height;
		
		
//////////////////////////////////////////////////////////////////////////////////////////////

  }
}
 if (($max==$cp) or ($cp==25))
    {
				$pdf->AddPage();
		
				$y_axis_initial = 17;
				// imprime el titulo de la pagina
				$pdf->SetFillColor(256,256,256);
				$pdf->SetFont('Arial','B',8);
				$pdf->SetY($y_axis_initial);
				$pdf->Image('../img/tgp_01.jpg',30,6,25);
		//$pdf->Image('../img/tgp_02.jpg',75,6,10);
		
		$pdf->SetFont('Arial','B',6);
		//$pdf->setX(150);
		// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
		//$pdf->setY(25);
		$pdf->SetY(15);
		$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
		$pdf->SetY($y_axis_initial+4);
		$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);
		$pdf->SetY($y_axis_initial+8);
		$pdf->SetFont('Arial','B',6);
		//$pdf->cell(0,0,'Nº Autorizacion: '.$nro,0,'B','R',0);
		///$pdf->SetY($y_axis_initial+12);
		
		$pdf->Cell(0,0,'Pagina: '.$pdf->PageNo().'/{nb}',0,'B','R',0);
		$pdf->AliasNbPages();
		//Launch the print dialog
		//$pdf->AutoPrint(true);
		
		//set initial y axis position per page
		$y_axis_initial = 30;
		$pdf->SetY($y_axis_initial);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetX(5);
		$pdf->cell(0,0,'EJERCICIO: '.$fecha_cons ,0,'B','L',0);
		$pdf->SetX(50);
		$pdf->Cell(0,0,'NUEVAS ORDENES DE PAGOS PENDIENTE DE CANCELACION
		','0',0,'L',0);
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',10);
		$i=35;
		$pdf->SetY($i);
		$pdf->SetX(5);
		$pdf->Cell(0,4,'','T',0,'L',1);
		
		
		///////////////////////////////////////////////////////////////////////////////////////
		
		////// DETALLE DEL PRESUPUESTO
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','UB',5);
		$pdf->SetY($i=$i+7);
		$pdf->SetX(0);
		$pdf->Cell(30,6,'Escritural',0,0,'C',0);
		$pdf->Cell(25,6,'Formul',0,0,'C',0);
		$pdf->Cell(10,6,'Fuente',0,0,'C',0);
		$pdf->Cell(10,6,'Clase',0,0,'C',0);
		$pdf->Cell(35,6,'Beneficiario',0,0,'C',0);
		$pdf->Cell(35,6,'Concepto',0,0,'C',0);
		$pdf->Cell(20,6,'Imp. del Form',0,0,'C',0);
		$pdf->Cell(20,6,'Pagado',0,0,'C',0);
		$pdf->Cell(20,6,'Saldo',0,0,'C',0);
		
		//$aux=='';
		$pdf->SetY($i=$i+2);
		$cp=0;
				//$y_axis=54;
				$row_height = 7;
				$InterLigne = 4;
	}
  
        $pdf->SetFont('courier','B',6);
        $pdf->SetFillColor(256,256,256);
		$pdf->SetY($i=$i+2);
		$pdf->SetX(0);   
		//$pdf->Cell(60,6,'TOTAL DEL SERVICIO :'.$esc,1,0,'L',1);
		$pdf->Cell(165,6,number_format($tot_importe,2),0,0,'R',1);
		$pdf->Cell(20,6,number_format($tot_pagado,2),0,0,'R',1);
		$pdf->Cell(20,6,number_format($tot_saldo,2),0,0,'R',1);
		$pdf->SetY($i=$i+5);
        $pdf->SetX(5);
        $pdf->Cell(200,4,'','T',0,'L',1);
		
  	    $tot_gral_importe=$tot_gral_importe+$tot_importe;
	    $tot_gral_pagado=$tot_gral_pagado+$tot_pagado;
	    $tot_gral_saldo=$tot_gral_saldo+$tot_saldo;
		
if($id==0)
{
			$pdf->SetY($i=$i+2);

		$pdf->SetX(0);   
		//$pdf->Cell(60,6,'TOTAL DEL SERVICIO :'.$esc,1,0,'L',1);
		$pdf->Cell(165,6,number_format($tot_gral_importe,2),0,0,'R',1);
		$pdf->Cell(20,6,number_format($tot_gral_pagado,2),0,0,'R',1);
		$pdf->Cell(20,6,number_format($tot_gral_saldo,2),0,0,'R',1);
		$pdf->SetY($i=$i+5);
        $pdf->SetX(5);
        $pdf->Cell(200,4,'','T',0,'L',1);
///////////

}
  $tot_importe=0;
	$tot_pagado=0;
	$tot_saldo=0;
	$tot_auto=0;
	$tot_nuevo_sal=0;
	$tot_gral_importe=0;
	$tot_gral_pagado=0;
	$tot_gral_saldo=0;
	$tot_gral_auto=0;
	$tot_gral_nuevo_sal=0;
 $cp=0;
 $pdf->AddPage();

$y_axis_initial = 17;
// imprime el titulo de la pagina
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($y_axis_initial);
$pdf->Image('../img/tgp_01.jpg',30,6,25);
//$pdf->Image('../img/tgp_02.jpg',75,6,10);

$pdf->SetFont('Arial','B',6);
//$pdf->setX(150);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
//$pdf->setY(25);
$pdf->SetY(15);
$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
$pdf->SetY($y_axis_initial+4);
$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);
$pdf->SetY($y_axis_initial+8);
$pdf->SetFont('Arial','B',6);
//$pdf->cell(0,0,'Nº Autorizacion: '.$nro,0,'B','R',0);
///$pdf->SetY($y_axis_initial+12);

$pdf->Cell(0,0,'Pagina: '.$pdf->PageNo().'/{nb}',0,'B','R',0);
$pdf->AliasNbPages();
//Launch the print dialog
//$pdf->AutoPrint(true);

//set initial y axis position per page
$y_axis_initial = 30;
$pdf->SetY($y_axis_initial);
$pdf->SetFont('Arial','B',10);
$pdf->SetX(5);
$pdf->cell(0,0,'EJERCICIO: '.$fecha_cons ,0,'B','L',0);
$pdf->SetX(50);
$pdf->Cell(0,0,'NUEVAS ORDENES DE PAGOS RESIDUAL
','0',0,'L',0);

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',10);
$i=35;
$pdf->SetY($i);
$pdf->SetX(5);
$pdf->Cell(0,4,'','T',0,'L',1);


///////////////////////////////////////////////////////////////////////////////////////

////// DETALLE DEL PRESUPUESTO

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','UB',5);
$pdf->SetY($i=$i+7);
$pdf->SetX(0);
$pdf->Cell(20,6,'Escritural',0,0,'C',0);
$pdf->Cell(25,6,'Formul',0,0,'C',0);
$pdf->Cell(20,6,'Cuenta',0,0,'C',0);
$pdf->Cell(10,6,'Clase',0,0,'C',0);
$pdf->Cell(35,6,'Beneficiario',0,0,'C',0);
$pdf->Cell(35,6,'Concepto',0,0,'C',0);
$pdf->Cell(20,6,'Imp. del Form',0,0,'C',0);
$pdf->Cell(20,6,'Pagado',0,0,'C',0);
$pdf->Cell(20,6,'Saldo',0,0,'C',0);

$aux1=='0';
$pdf->SetY($i=$i+2);
//$y_axis=54;
$row_height = 7;
$InterLigne = 4;

while($row = mysql_fetch_array($r_op_i))
{
	$esc=$row['ESCRITURAL']; 
	if($aux1==0)
	  {
		$aux1=$esc;  
	  }
 if($aux1==$esc)
   {		
		  	
  if ($max==$cp)
    {
	 	$pdf->AddPage();

		$y_axis_initial = 17;
		// imprime el titulo de la pagina
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',8);
		$pdf->SetY($y_axis_initial);
		$pdf->Image('../img/tgp_01.jpg',30,6,25);
//$pdf->Image('../img/tgp_02.jpg',75,6,10);

$pdf->SetFont('Arial','B',6);
//$pdf->setX(150);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
//$pdf->setY(25);
$pdf->SetY(15);
$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
$pdf->SetY($y_axis_initial+4);
$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);
$pdf->SetY($y_axis_initial+8);
$pdf->SetFont('Arial','B',6);
//$pdf->cell(0,0,'Nº Autorizacion: '.$nro,0,'B','R',0);
///$pdf->SetY($y_axis_initial+12);

$pdf->Cell(0,0,'Pagina: '.$pdf->PageNo().'/{nb}',0,'B','R',0);
$pdf->AliasNbPages();
//Launch the print dialog
//$pdf->AutoPrint(true);

//set initial y axis position per page
$y_axis_initial = 30;
$pdf->SetY($y_axis_initial);
$pdf->SetFont('Arial','B',12);
$pdf->SetX(5);
$pdf->cell(0,0,'EJERCICIO: '.$fecha_cons ,0,'B','L',0);
$pdf->SetX(50);
$pdf->Cell(0,0,'NUEVAS ORDENES DE PAGOS RESIDUAL
','0',0,'L',0);

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',10);
$i=35;
$pdf->SetY($i);
$pdf->SetX(5);
$pdf->Cell(0,4,'','T',0,'L',1);


///////////////////////////////////////////////////////////////////////////////////////

////// DETALLE DEL PRESUPUESTO

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','UB',5);
$pdf->SetY($i=$i+7);
$pdf->SetX(0);
$pdf->Cell(20,6,'Escritural',0,0,'C',0);
$pdf->Cell(25,6,'Formul',0,0,'C',0);
$pdf->Cell(20,6,'Cuenta',0,0,'C',0);
$pdf->Cell(10,6,'Clase',0,0,'C',0);
$pdf->Cell(35,6,'Beneficiario',0,0,'C',0);
$pdf->Cell(35,6,'Concepto',0,0,'C',0);
$pdf->Cell(20,6,'Imp. del Form',0,0,'C',0);
$pdf->Cell(20,6,'Pagado',0,0,'C',0);
$pdf->Cell(20,6,'Saldo',0,0,'C',0);

//$aux=='';
$pdf->SetY($i=$i+2);
$cp=0;
		//$y_axis=54;
		$row_height = 7;
		$InterLigne = 4;
	}
  
  //If the current row is the last one, create new page and print column title
    
	       $saf = $row['SAF'];
	   
	       $d_cuit=$row['CUIT'];
		    $inhi=$row['inhi'];
		   $beneficiario = $row['BENEFICIARIO'];
		    $concepto = $row['CONCEPTO'];
		   $fuente = $row['FUENTE'];
		   $clase = $row['CLASE'];
		  // $estado_op=$f_orden['ESTADO'];
		   $orden=$row['NUMERO'];
		   $num=$row['FORMULARIO']; 
		   
		   $IMP1= number_format($row['IMP_FORM'],2);
		   $IMP2=number_format($row['RETENCION'],2);
		   $IMP3=number_format($row['IMPORTE_A_PAGAR'],2);
		   $Imp_orden=number_format($row['Imp_orden'],2);
           $Total_Pagado=number_format($row['pagado'],2);
			 
			//$esc=$row['ESCRITURAL']; 
			$den=$row['DENOMINACION'];
			  
			 $orden1=$num.'-'.$saf.'-'.$orden;
		   
		  /*$formul = $row['Numero_OP'];
		  $fuente = $row['Fuente'];
		  $clase = $row['Clase'];
		  
		  $concepto = $row['Concepto'];
		  $importe = $row['Imp_orden'];
		  $pagado = $row['Total_Pagado'];
		  $saldo = $row['Saldos'];
		  $autorizado = $row['autorizado'];*/
		  
		//  $nuevo_saldo=$saldo-$autorizado;
		  
		  $tot_importe=$tot_importe+$row['Imp_orden'];
		  
		  $tot_pagado=$tot_pagado+$row['pagado'];
		  
		  $tot_saldo=$tot_saldo+$row['IMPORTE_A_PAGAR'];
		  
		
    
   
   
		$pdf->SetFont('courier','',6);
		$pdf->SetY($i=$i+3);
		$pdf->SetX(0);
        $pdf->Cell(20,5,$esc,0,0,'C',1);
		$pdf->Cell(25,5,$orden1,0,0,'C',1);
		$pdf->Cell(20,5,$inhi,0,0,'C',1);
		$pdf->Cell(10,5,$clase,0,0,'C',1);
		//$pdf->SetFont('courier','',6);
		$pdf->Cell(35,5,$beneficiario,0,0,'L',1);
		$pdf->Cell(35,5,substr($concepto,5,25),0,0,'L',1);
		$pdf->SetFont('courier','',6);
		$pdf->Cell(20,5,$Imp_orden,0,0,'R',1);
		$pdf->Cell(20,5,$Total_Pagado,0,0,'R',1);
		$pdf->Cell(20,5,$IMP3,0,0,'R',1);
     
	 	$pdf->SetY($i=$i+5);
        $pdf->SetX(5);
        $pdf->Cell(200,4,'','T',0,'L',1);
 
	//$pdf->line(15,$y_axis,205,$y_axis); 
        $cp=$cp+1; 
	    $y_axis = $y_axis + $row_height;
		
	}
else
  {	
  $aux1=$esc;
     if (($max==$cp) or ($cp==20))
    {
				$pdf->AddPage();
		
				$y_axis_initial = 17;
				// imprime el titulo de la pagina
				$pdf->SetFillColor(256,256,256);
				$pdf->SetFont('Arial','B',8);
				$pdf->SetY($y_axis_initial);
				$pdf->Image('../img/tgp_01.jpg',30,6,25);
		//$pdf->Image('../img/tgp_02.jpg',75,6,10);
		
		$pdf->SetFont('Arial','B',6);
		//$pdf->setX(150);
		// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
		//$pdf->setY(25);
		$pdf->SetY(15);
		$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
		$pdf->SetY($y_axis_initial+4);
		$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);
		$pdf->SetY($y_axis_initial+8);
		$pdf->SetFont('Arial','B',6);
		//$pdf->cell(0,0,'Nº Autorizacion: '.$nro,0,'B','R',0);
		///$pdf->SetY($y_axis_initial+12);
		
		$pdf->Cell(0,0,'Pagina: '.$pdf->PageNo().'/{nb}',0,'B','R',0);
		$pdf->AliasNbPages();
		//Launch the print dialog
		//$pdf->AutoPrint(true);
		
		//set initial y axis position per page
		$y_axis_initial = 30;
		$pdf->SetY($y_axis_initial);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetX(5);
		$pdf->cell(0,0,'EJERCICIO: '.$fecha_cons ,0,'B','L',0);
		$pdf->SetX(50);
		$pdf->Cell(0,0,'NUEVAS ORDENES DE PAGOS RESIDUAL
		','0',0,'L',0);
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',10);
		$i=35;
		$pdf->SetY($i);
		$pdf->SetX(5);
		$pdf->Cell(0,4,'','T',0,'L',1);
		
		
		///////////////////////////////////////////////////////////////////////////////////////
		
		////// DETALLE DEL PRESUPUESTO
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','UB',5);
		$pdf->SetY($i=$i+7);
		$pdf->SetX(0);
		$pdf->Cell(20,6,'Escritural',0,0,'C',0);
		$pdf->Cell(25,6,'Formul',0,0,'C',0);
		$pdf->Cell(20,6,'Fuente',0,0,'C',0);
		$pdf->Cell(10,6,'Clase',0,0,'C',0);
		$pdf->Cell(35,6,'Beneficiario',0,0,'C',0);
		$pdf->Cell(35,6,'Concepto',0,0,'C',0);
		$pdf->Cell(20,6,'Imp. del Form',0,0,'C',0);
		$pdf->Cell(20,6,'Pagado',0,0,'C',0);
		$pdf->Cell(20,6,'Saldo',0,0,'C',0);
		
		//$aux=='';
		$pdf->SetY($i=$i+2);
		$cp=0;
				//$y_axis=54;
				$row_height = 7;
				$InterLigne = 4;
	}
  
        $pdf->SetFont('courier','B',6);
        $pdf->SetFillColor(256,256,256);
		$pdf->SetY($i=$i+2);
		$pdf->SetX(0);   
		//$pdf->Cell(60,6,'TOTAL DEL SERVICIO :'.$esc,1,0,'L',1);
		$pdf->Cell(165,6,number_format($tot_importe,2),0,0,'R',1);
		$pdf->Cell(20,6,number_format($tot_pagado,2),0,0,'R',1);
		$pdf->Cell(20,6,number_format($tot_saldo,2),0,0,'R',1);
		$pdf->SetY($i=$i+5);
        $pdf->SetX(5);
        $pdf->Cell(200,4,'','T',0,'L',1);
		
  	    $tot_gral_importe=$tot_gral_importe+$tot_importe;
	    $tot_gral_pagado=$tot_gral_pagado+$tot_pagado;
	    $tot_gral_saldo=$tot_gral_saldo+$tot_saldo;
		$tot_importe=0;
	    $tot_pagado=0;
	    $tot_saldo=0;
		  
	  $saf = $row['SAF'];
	   
	       $d_cuit=$row['CUIT'];
		    $inhi=$row['inhi'];
		   $beneficiario = $row['BENEFICIARIO'];
		    $concepto = $row['CONCEPTO'];
		   $fuente = $row['FUENTE'];
		   $clase = $row['CLASE'];
		  // $estado_op=$f_orden['ESTADO'];
		   $orden=$row['NUMERO'];
		   $num=$row['FORMULARIO']; 
		   
		   $IMP1= number_format($row['IMP_FORM'],2);
		   $IMP2=number_format($row['RETENCION'],2);
		   $IMP3=number_format($row['IMPORTE_A_PAGAR'],2);
		   $Imp_orden=number_format($row['Imp_orden'],2);
           $Total_Pagado=number_format($row['pagado'],2);
			 
		//	$esc=$row['escritural']; 
			$den=$row['DENOMINACION'];
			  
			 $orden1=$num.'-'.$saf.'-'.$orden;
		   
		  /*$formul = $row['Numero_OP'];
		  $fuente = $row['Fuente'];
		  $clase = $row['Clase'];
		  
		  $concepto = $row['Concepto'];
		  $importe = $row['Imp_orden'];
		  $pagado = $row['Total_Pagado'];
		  $saldo = $row['Saldos'];
		  $autorizado = $row['autorizado'];*/
		  
		//  $nuevo_saldo=$saldo-$autorizado;
		  
		  $tot_importe=$tot_importe+$row['Imp_orden'];
		  
		  $tot_pagado=$tot_pagado+$row['pagado'];
		  
		  $tot_saldo=$tot_saldo+$row['IMPORTE_A_PAGAR'];
		  
		
    
 if($cp>22)
      {
				$pdf->AddPage();
		
				$y_axis_initial = 17;
				// imprime el titulo de la pagina
				$pdf->SetFillColor(256,256,256);
				$pdf->SetFont('Arial','B',8);
				$pdf->SetY($y_axis_initial);
				$pdf->Image('../img/tgp_01.jpg',30,6,25);
		//$pdf->Image('../img/tgp_02.jpg',75,6,10);
		
		$pdf->SetFont('Arial','B',6);
		//$pdf->setX(150);
		// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
		//$pdf->setY(25);
		$pdf->SetY(15);
		$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
		$pdf->SetY($y_axis_initial+4);
		$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);
		$pdf->SetY($y_axis_initial+8);
		$pdf->SetFont('Arial','B',6);
		//$pdf->cell(0,0,'Nº Autorizacion: '.$nro,0,'B','R',0);
		///$pdf->SetY($y_axis_initial+12);
		
		$pdf->Cell(0,0,'Pagina: '.$pdf->PageNo().'/{nb}',0,'B','R',0);
		$pdf->AliasNbPages();
		//Launch the print dialog
		//$pdf->AutoPrint(true);
		
		//set initial y axis position per page
		$y_axis_initial = 30;
		$pdf->SetY($y_axis_initial);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetX(5);
		$pdf->cell(0,0,'EJERCICIO: '.$fecha_cons ,0,'B','L',0);
		$pdf->SetX(50);
		$pdf->Cell(0,0,'NUEVAS ORDENES DE PAGOS RESIDUAL
		','0',0,'L',0);
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',10);
		$i=35;
		$pdf->SetY($i);
		$pdf->SetX(5);
		$pdf->Cell(0,4,'','T',0,'L',1);
		
		
		///////////////////////////////////////////////////////////////////////////////////////
		
		////// DETALLE DEL PRESUPUESTO
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','UB',5);
		$pdf->SetY($i=$i+7);
		$pdf->SetX(0);
		$pdf->Cell(20,6,'Escritural',0,0,'C',0);
		$pdf->Cell(25,6,'Formul',0,0,'C',0);
		$pdf->Cell(20,6,'Fuente',0,0,'C',0);
		$pdf->Cell(10,6,'Clase',0,0,'C',0);
		$pdf->Cell(35,6,'Beneficiario',0,0,'C',0);
		$pdf->Cell(35,6,'Concepto',0,0,'C',0);
		$pdf->Cell(20,6,'Imp. del Form',0,0,'C',0);
		$pdf->Cell(20,6,'Pagado',0,0,'C',0);
		$pdf->Cell(20,6,'Saldo',0,0,'C',0);
		
		//$aux=='';
		$pdf->SetY($i=$i+2);
		$cp=0;
				//$y_axis=54;
				$row_height = 7;
				$InterLigne = 4;
	  }
   
		$pdf->SetFont('courier','',6);
		$pdf->SetY($i=$i+3);
		$pdf->SetX(0);
        $pdf->Cell(20,5,$esc,0,0,'C',1);
		$pdf->Cell(25,5,$orden1,0,0,'C',1);
		$pdf->Cell(20,5,$inhi,0,0,'C',1);
		$pdf->Cell(10,5,$clase,0,0,'C',1);
		//$pdf->SetFont('courier','',6);
		$pdf->Cell(35,5,$beneficiario,0,0,'L',1);
		$pdf->Cell(35,5,substr($concepto,5,25),0,0,'L',1);
		$pdf->SetFont('courier','',6);
		$pdf->Cell(20,5,$Imp_orden,0,0,'R',1);
		$pdf->Cell(20,5,$Total_Pagado,0,0,'R',1);
		$pdf->Cell(20,5,$IMP3,0,0,'R',1);
     
	 	$pdf->SetY($i=$i+5);
        $pdf->SetX(5);
        $pdf->Cell(200,4,'','T',0,'L',1);
 
	//$pdf->line(15,$y_axis,205,$y_axis); 
        $cp=$cp+1; 
	    $y_axis = $y_axis + $row_height;
		
		
//////////////////////////////////////////////////////////////////////////////////////////////

  }
}
 if (($max==$cp) or ($cp==20))
    {
				$pdf->AddPage();
		
				$y_axis_initial = 17;
				// imprime el titulo de la pagina
				$pdf->SetFillColor(256,256,256);
				$pdf->SetFont('Arial','B',8);
				$pdf->SetY($y_axis_initial);
				$pdf->Image('../img/tgp_01.jpg',30,6,25);
		//$pdf->Image('../img/tgp_02.jpg',75,6,10);
		
		$pdf->SetFont('Arial','B',6);
		//$pdf->setX(150);
		// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
		//$pdf->setY(25);
		$pdf->SetY(15);
		$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
		$pdf->SetY($y_axis_initial+4);
		$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);
		$pdf->SetY($y_axis_initial+8);
		$pdf->SetFont('Arial','B',6);
		//$pdf->cell(0,0,'Nº Autorizacion: '.$nro,0,'B','R',0);
		///$pdf->SetY($y_axis_initial+12);
		
		$pdf->Cell(0,0,'Pagina: '.$pdf->PageNo().'/{nb}',0,'B','R',0);
		$pdf->AliasNbPages();
		//Launch the print dialog
		//$pdf->AutoPrint(true);
		
		//set initial y axis position per page
		$y_axis_initial = 30;
		$pdf->SetY($y_axis_initial);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetX(5);
		$pdf->cell(0,0,'EJERCICIO: '.$fecha_cons ,0,'B','L',0);
		$pdf->SetX(50);
		$pdf->Cell(0,0,'NUEVAS ORDENES DE PAGOS RESIDUAL
		','0',0,'L',0);
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',10);
		$i=35;
		$pdf->SetY($i);
		$pdf->SetX(5);
		$pdf->Cell(0,4,'','T',0,'L',1);
		
		
		///////////////////////////////////////////////////////////////////////////////////////
		
		////// DETALLE DEL PRESUPUESTO
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','UB',5);
		$pdf->SetY($i=$i+7);
		$pdf->SetX(0);
		$pdf->Cell(20,6,'Escritural',0,0,'C',0);
		$pdf->Cell(25,6,'Formul',0,0,'C',0);
		$pdf->Cell(20,6,'Fuente',0,0,'C',0);
		$pdf->Cell(10,6,'Clase',0,0,'C',0);
		$pdf->Cell(35,6,'Beneficiario',0,0,'C',0);
		$pdf->Cell(35,6,'Concepto',0,0,'C',0);
		$pdf->Cell(20,6,'Imp. del Form',0,0,'C',0);
		$pdf->Cell(20,6,'Pagado',0,0,'C',0);
		$pdf->Cell(20,6,'Saldo',0,0,'C',0);
		
		//$aux=='';
		$pdf->SetY($i=$i+2);
		$cp=0;
				//$y_axis=54;
				$row_height = 7;
				$InterLigne = 4;
	}

 
        $pdf->SetFont('courier','B',6);
        $pdf->SetFillColor(256,256,256);
		$pdf->SetY($i=$i+2);
		$pdf->SetX(0);   
		//$pdf->Cell(60,6,'TOTAL DEL SERVICIO :'.$esc,1,0,'L',1);
		$pdf->Cell(165,6,number_format($tot_importe,2),0,0,'R',1);
		$pdf->Cell(20,6,number_format($tot_pagado,2),0,0,'R',1);
		$pdf->Cell(20,6,number_format($tot_saldo,2),0,0,'R',1);
		$pdf->SetY($i=$i+5);
        $pdf->SetX(5);
        $pdf->Cell(200,4,'','T',0,'L',1);
		
  	    $tot_gral_importe=$tot_gral_importe+$tot_importe;
	    $tot_gral_pagado=$tot_gral_pagado+$tot_pagado;
	    $tot_gral_saldo=$tot_gral_saldo+$tot_saldo;
		
	if($id=='')
{ 		$pdf->SetY($i=$i+2);
		$pdf->SetX(0);   
		//$pdf->Cell(60,6,'TOTAL DEL SERVICIO :'.$esc,1,0,'L',1);
		$pdf->Cell(165,6,number_format($tot_gral_importe,2),0,0,'R',1);
		$pdf->Cell(20,6,number_format($tot_gral_pagado,2),0,0,'R',1);
		$pdf->Cell(20,6,number_format($tot_gral_saldo,2),0,0,'R',1);
		$pdf->SetY($i=$i+5);
        $pdf->SetX(5);
        $pdf->Cell(200,4,'','T',0,'L',1);
///////////

}
 
$pdf->Output();



