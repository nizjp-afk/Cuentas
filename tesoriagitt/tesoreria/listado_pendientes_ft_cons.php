<?php
    
   error_reporting ( E_ERROR );
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    //include('conexion/extras.php');
 	
	///////////////////////////////////////////////////////
   
	$cuit=$_GET['dato'];
	$fecha_cons=$_GET['fecha_cons'];
	$nom=$_GET['saf'];
	///////////////////
	
	$f=strftime("%Y-%m-%d");
   $dia = date("d/m/Y");
   $hora =date("h:i");
   
   
    ////////////////////////////
	 function restaFechas($dFecIni, $dFecFin)
{
    $dFecIni = str_replace("-","",$dFecIni);
    $dFecIni = str_replace("/","",$dFecIni);
    $dFecFin = str_replace("-","",$dFecFin);
    $dFecFin = str_replace("/","",$dFecFin);

    ereg( "([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})", $dFecIni, $aFecIni);
    ereg( "([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})", $dFecFin, $aFecFin);

    $date1 = mktime(0,0,0,$aFecIni[2], $aFecIni[1], $aFecIni[3]);
    $date2 = mktime(0,0,0,$aFecFin[2], $aFecFin[1], $aFecFin[3]);

    return round(($date2 - $date1) / (60 * 60 * 24));
	
	}
	  $diaa = date("d-m-Y");
   ////////////////////////////
	
/*   if($nom!='')
      {
		 $_pagi_sql = "SELECT CASE estado
WHEN 'N'
THEN 'P'
WHEN 'B'
THEN 'A'
WHEN 'R'
THEN 'B'
END AS estado, op_pendientes . *
FROM op_pendientes where (Saf='$nom' or Numero_OP='$nom' or cuit='$nom') AND Ejercicio='$fecha_cons' ORDER BY `estado` DESC";
							  
	  }
	  else
	   {
		  $_pagi_sql = "SELECT CASE estado
WHEN 'N'
THEN 'P'
WHEN 'B'
THEN 'A'
WHEN 'R'
THEN 'B'
END AS estado, op_pendientes . * FROM op_pendientes
		                where Ejercicio='$fecha_cons'
						ORDER BY saf ASC ,`estado` DESC,Numero_OP  ASC";  */
						
if($nom!='')
      {
		 $_pagi_sql = "SELECT  *
FROM op_pendientes where (Saf='$nom' or Numero_OP='$nom' or cuit='$nom') AND estado='N' AND Ejercicio='$fecha_cons' ORDER BY Numero_OP  ASC";
							  
	  }
	  else
	   {
		  $_pagi_sql = "SELECT * FROM op_pendientes
		                where Ejercicio='$fecha_cons'
						and estado='N'
						ORDER BY saf ASC ,Numero_OP  ASC";
	   }
			 if (!($ordenes= mysql_query($_pagi_sql, $conexion_mysql)))
			{
			
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes";
			  echo $cuerpo1;
			  //.....................................................................
			}  
	
	
	
			
$cant = mysql_num_rows($ordenes);  

			



  
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
if($cant>0)
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
$pdf->cell(0,0,'LISTADO DE ORDENES DE PAGO PENDIENTES ',0,'B','C',0);


$y_axis_initial = 55;

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',6);
$pdf->SetY($y_axis_initial);
$pdf->SetX(10);


$pdf->Cell(10,7,'Nº',1,0,'C',1);
$pdf->Cell(13,7,'Ejercicio',1,0,'C',1);
$pdf->Cell(20,7,'Fecha',1,0,'C',1);
$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
$pdf->Cell(10,7,'Saf',1,0,'C',1);
$pdf->Cell(60,7,'Beneficiarios',1,0,'C',1);
$pdf->Cell(60,7,'Concepto',1,0,'C',1);
$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);

$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
$pdf->Cell(15,7,'Estado',1,0,'C',1);






$i =55+4;
$ic =0;

//Set maximum rows per page
$max = 17;
$y_axis=62;
//Set Row Height
$row_height = 7;
$cont=0;

while($f_ordenes= mysql_fetch_array ($ordenes))
{
			   
			//If the current row is the last one, create new page and print column title
			if ($ic == $max)
			{
						   

			//$pdf->SetTopMargin(25);
			

///////////////////
$pdf->SetY(-20);
//Select Arial italic 8
$pdf->SetFont('Arial','IB',8);
 //Print current and total page numbers
$pdf->Cell(0,4,'REFERENCIA: ',0,0,'L');
 $pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','I',6);
 //Print current and total page numbers

$pdf->MultiCell(0,4,'BAJR: Baja/Retenciones  -  BLOR: Bloqueo/Retenciones - IMP: Control de Impuesto - BAJAD: Baja - Dec 1804/10 + 365 dias  - BENB: Beneficiario Inhabilitado  -  BENC: Cuenta Cerrada',1,'J',0,8);
	

$pdf->SetY(-8);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');			//Add first page
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
			$pdf->cell(0,0,'LISTADO DE ORDENES DE PAGO PENDIENTES ',0,'B','C',0);
			
			
			$y_axis_initial = 55;
			
			$pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',6);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(10);
			$pdf->Cell(10,7,'Nº',1,0,'C',1);
$pdf->Cell(13,7,'Ejercicio',1,0,'C',1);
$pdf->Cell(20,7,'Fecha',1,0,'C',1);

$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
$pdf->Cell(10,7,'Saf',1,0,'C',1);
$pdf->Cell(60,7,'Beneficiarios',1,0,'C',1);
$pdf->Cell(60,7,'Concepto',1,0,'C',1);
$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);

$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);

$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
$pdf->Cell(15,7,'Estado',1,0,'C',1);

			$i =55+4;
$ic =0;
			//Set maximum rows per page
			$max = 17;
			$y_axis=62;
			//Set Row Height
			$row_height = 7;
			

        //Set $i variable to 0 (first row)
        
    }

       $fecha=$f_ordenes['Fecha_OP'];
	   $ejercicio=$f_ordenes['Ejercicio'];
       $saf=$f_ordenes['Saf'];
       $orden_pago=$f_ordenes['Numero_OP'];
	   $sal_disp=$f_ordenes['Saldos'];
	   $imp_form=$f_ordenes['Imp_orden'];
	   $imp_pag=$f_ordenes['Total_Pagado'];
	   $benef=substr($f_ordenes['Beneficiario'],0,40);
	   $concepto=substr($f_ordenes['Concepto'],0,40);
	 //  $concepto=substr($f_ordenes['Concepto'],0,15);
	   $d_cuit=$f_ordenes['cuit'];
	   
	      $estado=$f_ordenes['estado'];
	 //  $concepto=substr($f_ordenes['Concepto'],0,15);
	  
	  
	  
	    $ssql = "SELECT * FROM beneficiarios_aprobados where cuitl='$d_cuit' ";
					 if (!($r_cb= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}
		   $f_cb=mysql_fetch_array($r_cb);
		   
		   $estado_ben=$f_cb['estado'];
		 $est='';   
		   $inhi=$f_cb['inhi'];
		   
		    if($inhi!=''){ $est='BENC';}
	        if($estado_ben=='B'){ $est='BENB';}
		     
	   
	   
	   
	   
	   
	 //  $concepto=substr($f_ordenes['Concepto'],0,15);
	  
	    $f_g=explode("-",$f_ordenes['Fecha_OP']); 
	    $fecha_ing=$f_g[2].'-'.$f_g[1].'-'.$f_g[0]; 
		 
	   $resultado_resta = restaFechas($fecha_ing,$diaa);
	//   if ($estado=='P'){$est='';}
		  if ($estado=='B'){$est='BLOR';}
		  if ($estado=='A'){$est='BAJR';}
		  if ($estado=='I'){$est='IMP';}
		 if($resultado_resta >365 ){$est='BAJD';} 
	  
	  
	  
	   
	/*   if($estado=='B'){$est='BLOQUEADA';}
	   if($estado=='A'){$est='BAJA';}
	   if($estado=='P'){$est='';}*/
	   
	$pdf->SetFont('courier',$negra,8);
		$pdf->SetY($i=$i+7);
	$pdf->SetX(10);
	$cont=$cont+1;
    $pdf->Cell(10,6,$cont,1,0,'C',1); 
	$pdf->Cell(13,6,$ejercicio,1,0,'C',1); 
	$pdf->Cell(20,6,$fecha,1,0,'L',1); 
	$pdf->Cell(20,6,$orden_pago,1,0,'L',1);
	$pdf->Cell(10,6,$saf,1,0,'C',1);
	$pdf->SetFont('courier',$negra,6);
    $pdf->Cell(60,6,$benef,1,0,'L',1);
	$pdf->Cell(60,6,$concepto,1,0,'L',1);
	$pdf->SetFont('courier',$negra,8);
	$pdf->Cell(25,6,$imp_form,1,0,'L',1);

	$pdf->Cell(25,6,$imp_pag,1,0,'R',1);
	$pdf->Cell(25,6,$sal_disp,1,0,'R',1);
	$pdf->Cell(15,6,$est,1,0,'L',1);
	
	
	$tot_importe=$tot_importe+$imp_form;
		  
	$tot_pagado=$tot_pagado+$imp_pag;
	 
	$tot_saldo=$tot_saldo+$sal_disp;
	 //  $pdf->Cell(35,6,$concepto,1,0,'L',1);
	
	
    //Go to next row
    $y_axis = $y_axis + $row_height;
    $ic = $ic + 1;
}
 if ($ic > 18)
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
			$pdf->cell(0,0,'LISTADO DE ORDENES DE PAGO PENDIENTES ',0,'B','C',0);
			
			
			$y_axis_initial = 55;
			
			$pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',6);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(15);
			$pdf->Cell(10,7,'Nº',1,0,'C',1);
			$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
			$pdf->Cell(10,7,'Saf',1,0,'C',1);
			$pdf->Cell(65,7,'Beneficiarios',1,0,'C',1);
			$pdf->Cell(65,7,'Concepto',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);

			$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
			$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
			$pdf->Cell(30,7,'Estado',1,0,'C',1);
						
			$i =55+4;
$ic =0;
			//Set maximum rows per page
			$max = 20;
			$y_axis=62;
			//Set Row Height
			$row_height = 7;
			
			$pdf->SetFont('courier','B',8);
		$pdf->SetFillColor(215,215,215);
		$pdf->SetY($y_axis);
		$pdf->SetX(185);   
			$pdf->Cell(25,6,number_format($tot_importe,2),1,0,'R',1);

		$pdf->Cell(25,6,number_format($tot_pagado,2),1,0,'R',1);

		$pdf->Cell(25,6,number_format($tot_saldo,2),1,0,'R',1);
			}
	else
 {
   $pdf->SetFont('courier','B',8);
		$pdf->SetFillColor(215,215,215);
		$pdf->SetY($i=$i+9);
		$pdf->SetX(185);   
			$pdf->Cell(25,6,number_format($tot_importe,2),1,0,'R',1);

		$pdf->Cell(25,6,number_format($tot_pagado,2),1,0,'R',1);

		$pdf->Cell(25,6,number_format($tot_saldo,2),1,0,'R',1);
		
 }
 }

		   

			//$pdf->SetTopMargin(25);
			

///////////////////
$pdf->SetY(-20);
//Select Arial italic 8
$pdf->SetFont('Arial','IB',8);
 //Print current and total page numbers
$pdf->Cell(0,4,'REFERENCIA: ',0,0,'L');
 $pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','I',6);
 //Print current and total page numbers

$pdf->MultiCell(0,4,'BAJR: Baja/Retenciones  -  BLOR: Bloqueo/Retenciones - IMP: Control de Impuesto - BAJAD: Baja - Dec 1804/10 + 365 dias  - BENB: Beneficiario Inhabilitado  -  BENC: Cuenta Cerrada',1,'J',0,8);
	

$pdf->SetY(-8);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');

$pdf->AliasNbPages();

//////// fin Formacion ACademica
$pdf->Output();
 
?>
