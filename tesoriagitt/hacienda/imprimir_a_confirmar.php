<?php
 error_reporting ( E_ERROR );
   //conexion
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
   // include('conexion/extras.php');
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	$saf = $_GET['saf'];
	$nro =$_GET['tei'];;
	
	//$fecha_cons=$_GET['consul'];	
	
	
	
	
	 $ssql = "SELECT * FROM op_pendiente_tmp  where nro_ti='$nro' order by Saf,Numero_OP ASC ";
     if (!($r_op= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
	
	 $ssql = "SELECT * FROM op_pendiente_tmp where `nro_ti` = '$nro' group by Ejercicio order by Ejercicio ";
     if (!($r_ope= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
   $cant = mysql_num_rows($r_op);
	
//////////////fin de consulta en base///////////
  
   $max=15;
   $f=strftime("%Y-%m-%d");
   $dia = date("d/m/Y");
   $hora =date("h:i");

//echo "paso";exit; 		
define('FPDF_FONTPATH','font/');
require('../fpdf.php');

//Connect to your database
//Create new pdf file
$pdf=new FPDF('L','mm','A4');
//$pdf=new FPDF('P','mm','A4'); // imprime hoja horizontal
//$pdf=new FPDF('P','mm','Legal');//imprime hoja vertical
while ($f_ope=mysql_fetch_array($r_ope))
  {
   $Ejercicio =$f_ope['Ejercicio'];
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
$pdf->Image('../img/tgp_02.jpg',75,6,10);

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
$pdf->cell(0,0,'Nº Autorizacion: '.$nro,0,'B','R',0);
$pdf->SetY($y_axis_initial+12);

$pdf->Cell(0,0,'Pagina: '.$pdf->PageNo().'/{nb}',0,'B','R',0);
$pdf->AliasNbPages();
//Launch the print dialog
//$pdf->AutoPrint(true);

//set initial y axis position per page
$y_axis_initial = 30;
$pdf->SetY($y_axis_initial);
$pdf->SetFont('Arial','B',12);
$pdf->SetX(30);
$pdf->cell(0,0,'EJERCICIO: '.$Ejercicio,0,'B','L',0);
$pdf->SetX(100);
$pdf->Cell(0,4,'CUMPLASE DE CUMPLASE DE RECURSOS DEL TESORO A CONFIRMAR','0',0,'L',0);

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',10);
$i=35;
$pdf->SetY($i);
$pdf->SetX(30);
$pdf->Cell(0,4,'','T',0,'L',1);


///////////////////////////////////////////////////////////////////////////////////////

////// DETALLE DEL PRESUPUESTO

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',6);
$pdf->SetY($i=$i+7);
$pdf->SetX(10);
$pdf->Cell(10,6,'Saf',1,0,'C',1);
$pdf->Cell(15,6,'Formul',1,0,'C',1);
$pdf->Cell(10,6,'Fuente',1,0,'C',1);
$pdf->Cell(10,6,'Clase',1,0,'C',1);
$pdf->Cell(45,6,'Beneficiario',1,0,'C',1);
$pdf->Cell(60,6,'Concepto',1,0,'C',1);
$pdf->Cell(27,6,'Imp. del Form',1,0,'C',1);
$pdf->Cell(27,6,'Pagado',1,0,'C',1);
$pdf->Cell(27,6,'Saldo',1,0,'C',1);
$pdf->Cell(27,6,'Autorizado',1,0,'C',1);
$pdf->Cell(27,6,'Nuevo Saldo',1,0,'C',1);

$aux=='';
//$y_axis=54;
$row_height = 7;
$InterLigne = 4;
mysql_data_seek($r_op,0);
while($row = mysql_fetch_array($r_op))
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
		$pdf->Image('../img/tgp_02.jpg',75,6,10);
		
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
		$pdf->cell(0,0,'Nº Autorizacion: '.$nro,0,'B','R',0);
	   $pdf->SetY($y_axis_initial+12);
       $pdf->Cell(0,0,'Pagina: '.$pdf->PageNo().'/{nb}',0,'B','R',0);
       $pdf->AliasNbPages();

		
		
		//set initial y axis position per page
		$y_axis_initial = 30;
		$pdf->SetY($y_axis_initial);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetX(30);
		$pdf->cell(0,0,'EJERCICIO: '.$Ejercicio,0,'B','L',0);
		$pdf->SetX(100);
		$pdf->Cell(0,4,'CUMPLASE DE CUMPLASE DE RECURSOS DEL TESORO A CONFIRMAR','0',0,'L',0);
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',10);
		$i=35;
		$pdf->SetY($i);
		$pdf->SetX(30);
		$pdf->Cell(0,4,'','T',0,'L',1);
		
		
		///////////////////////////////////////////////////////////////////////////////////////
		
		////// DETALLE DEL PRESUPUESTO
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',6);
		$pdf->SetY($i=$i+7);
		$pdf->SetX(10);
		$pdf->Cell(10,6,'Saf',1,0,'C',1);
		$pdf->Cell(15,6,'Formul',1,0,'C',1);
		$pdf->Cell(10,6,'Fuente',1,0,'C',1);
		$pdf->Cell(10,6,'Clase',1,0,'C',1);
		$pdf->Cell(45,6,'Beneficiario',1,0,'C',1);
		$pdf->Cell(60,6,'Concepto',1,0,'C',1);
$pdf->Cell(27,6,'Imp. del Form',1,0,'C',1);
$pdf->Cell(27,6,'Pagado',1,0,'C',1);
$pdf->Cell(27,6,'Saldo',1,0,'C',1);
$pdf->Cell(27,6,'Autorizado',1,0,'C',1);
$pdf->Cell(27,6,'Nuevo Saldo',1,0,'C',1);
		$cp=0;
		//$y_axis=54;
		$row_height = 7;
		$InterLigne = 4;
	}
  
  //If the current row is the last one, create new page and print column title
    if($row['Ejercicio']==$Ejercicio)
	  {
	   $saf = $row['Saf'];
	   if ($aux=='')
	     {
	    	  $aux=$saf;
		 }
	   if($aux==$saf)
	     {
		  $formul = $row['Numero_OP'];
		  $fuente = $row['Fuente'];
		  $clase = $row['Clase'];
		  $beneficiario = $row['Beneficiario'];
		  $concepto = $row['Concepto'];
		  $importe = $row['Imp_orden'];
		  $pagado = $row['Total_Pagado'];
		  $saldo = $row['Saldos'];
		  $autorizado = $row['autorizado'];
		  
		  $nuevo_saldo=$saldo-$autorizado;
		  
		  $tot_importe=$tot_importe+$importe;
		  
		  $tot_pagado=$tot_pagado+$pagado;
		  
		  $tot_saldo=$tot_saldo+$saldo;
		  
		  $tot_auto=$tot_auto+$autorizado;
		  
		  $tot_nuevo_sal=$tot_nuevo_sal+$nuevo_saldo;
    
   
   
		$pdf->SetFont('courier','',8);
		$pdf->SetY($i=$i+9);
		$pdf->SetX(10);
        $pdf->Cell(10,6,$saf,1,0,'C',1);
		$pdf->Cell(15,6,$formul,1,0,'C',1);
		$pdf->Cell(10,6,$fuente,1,0,'C',1);
		$pdf->Cell(10,6,$clase,1,0,'C',1);
		$pdf->SetFont('courier','',6);
		$pdf->Cell(45,6,$beneficiario,1,0,'L',1);
		$pdf->SetFont('courier','',6);
		$pdf->Cell(60,6,$concepto,1,0,'L',1);
		$pdf->SetFont('courier','',9);
		$pdf->Cell(27,6,number_format($importe,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($pagado,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($saldo,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($autorizado,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($nuevo_saldo,2),1,0,'R',1);

	//$pdf->line(15,$y_axis,205,$y_axis); 
        $cp=$cp+1; 
	    $y_axis = $y_axis + $row_height;
		if($cp==13)
		   {
			$pdf->SetFillColor(256,256,256);
			$pdf->SetFont('courier','B',12);
			$pdf->SetY(-7);
			$pdf->SetX(180);
			$pdf->Cell(60,3,'Firma  ',0,0,'R',1);   
		   }
	
		 }
	else
	  {
		  if ($cp > 13)
		    {
		     $pdf->AddPage();

		$y_axis_initial = 17;
		// imprime el titulo de la pagina
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',8);
		$pdf->SetY($y_axis_initial);
		$pdf->Image('../img/tgp_01.jpg',30,6,25);
		$pdf->Image('../img/tgp_02.jpg',75,6,10);
		
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
		$pdf->cell(0,0,'Nº Autorizacion: '.$nro,0,'B','R',0);
		$pdf->SetY($y_axis_initial+12);
        $pdf->Cell(0,0,'Pagina: '.$pdf->PageNo().'/{nb}',0,'B','R',0);
        $pdf->AliasNbPages();
		
		//set initial y axis position per page
		$y_axis_initial = 30;
		$pdf->SetY($y_axis_initial);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetX(30);
		$pdf->cell(0,0,'EJERCICIO: '.$Ejercicio,0,'B','L',0);
		$pdf->SetX(100);
		$pdf->Cell(0,4,'CUMPLASE DE CUMPLASE DE RECURSOS DEL TESORO A CONFIRMAR','0',0,'L',0);
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',10);
		$i=35;
		$pdf->SetY($i);
		$pdf->SetX(30);
		$pdf->Cell(0,4,'','T',0,'L',1);
		
		
		///////////////////////////////////////////////////////////////////////////////////////
		
		////// DETALLE DEL PRESUPUESTO
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',6);
		$pdf->SetY($i=$i+7);
		$pdf->SetX(10);
		$pdf->Cell(10,6,'Saf',1,0,'C',1);
		$pdf->Cell(15,6,'Formul',1,0,'C',1);
		$pdf->Cell(10,6,'Fuente',1,0,'C',1);
		$pdf->Cell(10,6,'Clase',1,0,'C',1);
		$pdf->Cell(45,6,'Beneficiario',1,0,'C',1);
		$pdf->Cell(60,6,'Concepto',1,0,'C',1);
$pdf->Cell(27,6,'Imp. del Form',1,0,'C',1);
$pdf->Cell(27,6,'Pagado',1,0,'C',1);
$pdf->Cell(27,6,'Saldo',1,0,'C',1);
$pdf->Cell(27,6,'Autorizado',1,0,'C',1);
$pdf->Cell(27,6,'Nuevo Saldo',1,0,'C',1);
		$cp=0;
		
		//$y_axis=54;
		$row_height = 7;
		$InterLigne = 4;
		
			}
		$pdf->SetFillColor(215,215,215);
		$pdf->SetFont('courier','B',8);	
		$pdf->SetY($i=$i+9);
		$pdf->SetX(115);   
		$pdf->Cell(45,6,'TOTAL DEL SERVICIO :'.$aux,1,0,'L',1);
		$pdf->Cell(27,6,number_format($tot_importe,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($tot_pagado,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($tot_saldo,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($tot_auto,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($tot_nuevo_sal,2),1,0,'R',1);
		
  	    $tot_gral_importe=$tot_gral_importe+$tot_importe;
	    
		$tot_gral_pagado=$tot_gral_pagado+$tot_pagado;
	    
		$tot_gral_saldo=$tot_gral_saldo+$tot_saldo;
	    
		$tot_gral_auto=$tot_gral_auto+$tot_auto;
	    
		$tot_gral_nuevo_sal=$tot_gral_nuevo_sal+$tot_nuevo_sal;
		
		  $aux=$saf;
		  $tot_importe=0;
		  $tot_pagado=0;
		  $tot_saldo=0;
		  $tot_auto=0;
		  $tot_nuevo_sal=0;
		  
		  $formul = $row['Numero_OP'];
		  $fuente = $row['Fuente'];
		  $clase = $row['Clase'];
		  $beneficiario = $row['Beneficiario'];
		  $concepto = $row['Concepto'];
		  $importe = $row['Imp_orden'];
		  $pagado = $row['Total_Pagado'];
		  $saldo = $row['Saldos'];
		  $autorizado = $row['autorizado'];
		  
		  $nuevo_saldo=$saldo-$autorizado;
		  
		  $tot_importe=$tot_importe+$importe;
		  
		  $tot_pagado=$tot_pagado+$pagado;
		  
		  $tot_saldo=$tot_saldo+$saldo;
		  
		  $tot_auto=$tot_auto+$autorizado;
		  
		  $tot_nuevo_sal=$tot_nuevo_sal+$nuevo_saldo;
    
   
        $pdf->SetFillColor(256,256,256);
		$pdf->SetFont('courier','',8);
		$pdf->SetY($i=$i+9);
		$pdf->SetX(10);
        $pdf->Cell(10,6,$saf,1,0,'C',1);
		$pdf->Cell(15,6,$formul,1,0,'C',1);
		$pdf->Cell(10,6,$fuente,1,0,'C',1);
		$pdf->Cell(10,6,$clase,1,0,'C',1);
		$pdf->SetFont('courier','',6);
		$pdf->Cell(45,6,$beneficiario,1,0,'L',1);
		$pdf->SetFont('courier','',5);
		$pdf->Cell(60,6,$concepto,1,0,'L',1);
		$pdf->SetFont('courier','',9);
		$pdf->Cell(27,6,number_format($importe,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($pagado,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($saldo,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($autorizado,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($nuevo_saldo,2),1,0,'R',1);

	//$pdf->line(15,$y_axis,205,$y_axis); 
        $cp=$cp+2; 
	    $y_axis = $y_axis + $row_height;
	}
			
  }
	  
  	  
}
  

if ($max==$cp )
    {
	 	$pdf->AddPage();

		$y_axis_initial = 17;
		// imprime el titulo de la pagina
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',8);
		$pdf->SetY($y_axis_initial);
		$pdf->Image('../img/tgp_01.jpg',30,6,25);
		$pdf->Image('../img/tgp_02.jpg',75,6,10);
		
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
		$pdf->cell(0,0,'Nº Autorizacion: '.$nro,0,'B','R',0);
		$pdf->SetY($y_axis_initial+12);

$pdf->Cell(0,0,'Pagina: '.$pdf->PageNo().'/{nb}',0,'B','R',0);
$pdf->AliasNbPages();
		
		//set initial y axis position per page
		$y_axis_initial = 30;
		$pdf->SetY($y_axis_initial);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetX(30);
		$pdf->cell(0,0,'EJERCICIO: '.$Ejercicio,0,'B','L',0);
		$pdf->SetX(100);
		$pdf->Cell(0,4,'CUMPLASE DE CUMPLASE DE RECURSOS DEL TESORO A CONFIRMAR','0',0,'L',0);
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',10);
		$i=35;
		$pdf->SetY($i);
		$pdf->SetX(30);
		$pdf->Cell(0,4,'','T',0,'L',1);
		
		
		///////////////////////////////////////////////////////////////////////////////////////
		
		////// DETALLE DEL PRESUPUESTO
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',6);
		$pdf->SetY($i=$i+7);
		$pdf->SetX(10);
		$pdf->Cell(10,6,'Saf',1,0,'C',1);
		$pdf->Cell(15,6,'Formul',1,0,'C',1);
		$pdf->Cell(10,6,'Fuente',1,0,'C',1);
		$pdf->Cell(10,6,'Clase',1,0,'C',1);
		$pdf->Cell(45,6,'Beneficiario',1,0,'C',1);
		$pdf->Cell(60,6,'Concepto',1,0,'C',1);
		$pdf->Cell(28,6,'Imp. del Form',1,0,'C',1);
		$pdf->Cell(23,6,'Pagado',1,0,'C',1);
		$pdf->Cell(23,6,'Saldo',1,0,'C',1);
		$pdf->Cell(23,6,'Autorizado',1,0,'C',1);
		$pdf->Cell(23,6,'Nuevo Saldo',1,0,'C',1);
		$cp=0;
		$aux=='';
		//$y_axis=54;
		$row_height = 7;
		$InterLigne = 4;
	}
        $pdf->SetFont('courier','B',8);
		$pdf->SetFillColor(215,215,215);
		$pdf->SetY($i=$i+9);
		$pdf->SetX(115);   
		$pdf->Cell(45,6,'TOTAL DEL SERVICIO :'.$aux,1,0,'L',1);
		$pdf->Cell(27,6,number_format($tot_importe,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($tot_pagado,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($tot_saldo,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($tot_auto,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($tot_nuevo_sal,2),1,0,'R',1);
  	    $tot_gral_importe=$tot_gral_importe+$tot_importe;
	    $tot_gral_pagado=$tot_gral_pagado+$tot_pagado;
	    $tot_gral_saldo=$tot_gral_saldo+$tot_saldo;
	    $tot_gral_auto=$tot_gral_auto+$tot_auto;
	    $tot_gral_nuevo_sal=$tot_gral_nuevo_sal+$tot_nuevo_sal;
		
		$aux=0;
        $pdf->SetY($i=$i+9);
		$pdf->SetX(115);   
		$pdf->Cell(45,6,'TOTAL  :',1,0,'L',1);
		$pdf->Cell(27,6,number_format($tot_gral_importe,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($tot_gral_pagado,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($tot_gral_saldo,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($tot_gral_auto,2),1,0,'R',1);
		$pdf->Cell(27,6,number_format($tot_gral_nuevo_sal,2),1,0,'R',1);
//////////////////////////////////////////////////////////////////////////////////////////////
$pdf->SetFillColor(256,256,256);
 $pdf->SetFont('courier','B',12);
$pdf->SetY(-7);
$pdf->SetX(180);
$pdf->Cell(60,3,'Firma  ',0,0,'R',1);


///////////

 }
$pdf->Output();



