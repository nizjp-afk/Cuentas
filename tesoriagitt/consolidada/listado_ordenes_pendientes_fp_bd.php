<?php
      error_reporting ( E_ERROR );
   
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
   $anterior=date('Y')-2;
   ////////////////////////////
	
   
		 $_pagi_sql = "SELECT orden_pago.* , (
IMP_FORM - RETENCION - IMPORTE_A_PAGAR
) AS pagado, (
IMP_FORM - RETENCION
) AS Imp_orden, e.ESCRITURAL,e.DENOMINACION,e.ID
FROM orden_pago, escritural AS e
WHERE (EJERCICIO >='$fecha_cons' and  EJERCICIO  <= '$anterior')
AND orden_pago.SAF='$saf'
AND e.ID = orden_pago.id_escritural
AND e.ESTADO='A'
AND orden_pago.ESTADO != 'C'
ORDER BY orden_pago.ESTADO DESC , FORMULARIO, NUMERO DESC";
							  
		
			 if (!($ordenes_p= mysql_query($_pagi_sql, $conexion_mysql)))
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
    $importe=$f_orden['importe'];
    $total=$f_orden['total'];
$cantp = mysql_num_rows($ordenes_p);

 $diaa = date("d-m-Y");
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
  
define('FPDF_FONTPATH','font/');
require('../fpdf.php');

//Connect to your database
//Create new pdf file
$pdf=new FPDF();
//$pdf=new PDF_AutoPrint();
$pdf=new FPDF('L','mm','A4');
//Open file
$pdf->Open();
$pdf->SetAutoPageBreak(false);

/*if($cantp>0)
  //{*/



//Disable automatic page break

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
$pdf->Cell(10,7,'Ejercicio',1,0,'C',1);
$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
$pdf->Cell(55,7,'Beneficiarios',1,0,'C',1);
$pdf->Cell(55,7,'Concepto',1,0,'C',1);
$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);
$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
$pdf->Cell(35,7,'Estado',1,0,'C',1);








$i = 0;

//Set maximum rows per page
$max = 18;
$y_axis=62;
//Set Row Height
$row_height = 7;
$cont=0;

while($f_ordenes_p= mysql_fetch_array ($ordenes_p))
{
			   
			//If the current row is the last one, create new page and print column title
			if ($i == $max)
			{
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
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');				//Add first page
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
$pdf->Cell(10,7,'Ejercicio',1,0,'C',1);
$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
$pdf->Cell(55,7,'Beneficiarios',1,0,'C',1);
$pdf->Cell(55,7,'Concepto',1,0,'C',1);
$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);
$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
$pdf->Cell(35,7,'Estado',1,0,'C',1);
						
			$i = 0;
			
			//Set maximum rows per page
			$max = 20;
			$y_axis=62;
			//Set Row Height
			$row_height = 7;
			

        //Set $i variable to 0 (first row)
        
    }

       $fecha=$f_ordenes_p['FECHA_OP'];
       $saf=$f_ordenes_p['Saf'];
      // $orden_pago=$f_ordenes['Numero_OP'];
	  // $sal_disp=$f_ordenes['Saldos'];
	  // $imp_form=$f_ordenes['Imp_orden'];
	  // $imp_pag=$f_ordenes['Total_Pagado'];
	   $benef=substr($f_ordenes_p['BENEFICIARIO'],0,40);
	   $concepto=substr($f_ordenes_p['CONCEPTO'],0,40);
	    $estado_op=$f_ordenes_p['ESTADO'];
	 //  $concepto=substr($f_ordenes['Concepto'],0,15);
	  
	       $d_cuit=$f_ordenes_p['CUIT'];
		   $orden=$f_ordenes_p['NUMERO'];
		   $op_saf=$f_ordenes_p['SAF'];
		   $ejer_op=$f_ordenes_p['EJERCICIO'];
		   $num=$f_ordenes_p['FORMULARIO']; 
		  
		   $IMP1= number_format($f_ordenes_p['IMP_FORM'],2);
		   $IMP2=number_format($f_ordenes_p['RETENCION'],2);
		   $IMP3=number_format($f_ordenes_p['IMPORTE_A_PAGAR'],2);
		   $Imp_orden=number_format($f_ordenes_p['Imp_orden'],2);
           $Total_Pagado=number_format($f_ordenes_p['pagado'],2);
			 
			 
			 $orden_pago=$num.'-'.$op_saf.'-'.$orden;
	  
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
		
		   $inhi=$f_cb['inhi'];
		   
		     $f_g=explode("-",$f_ordenes_p['FECHA_OP']); 
	         $fecha_ing=$f_g[2].'-'.$f_g[1].'-'.$f_g[0]; 
		   
		    if($inhi!=''){ $est='BENC';}
	        if($estado_ben=='B'){ $est='BENB';}
			
 $resultado_resta = restaFechas($fecha_ing,$diaa);
	 //  $concepto=substr($f_ordenes['Concepto'],0,15);
	 
	     // if ($estado_op=='P'){$est='';}
		  if ($estado_op=='B'){$est='BLOR';}
		  if ($estado_op=='A'){$est='BAJR';}
		  if ($estado_op=='I'){$est='IMP';}
		 if($resultado_resta >365 ){$est='BAJD';}
	  
	   
	$pdf->SetFont('courier',$negra,8);
	$pdf->SetY($y_axis);
	$pdf->SetX(15);
	$cont=$cont+1;
    $pdf->Cell(10,6,$cont,1,0,'C',1); 
	$pdf->Cell(10,6,$ejer_op,1,0,'C',1); 
	$pdf->Cell(20,6,$orden_pago,1,0,'C',1);
	$pdf->SetFont('courier',$negra,6);
    $pdf->Cell(55,6,$benef,1,0,'L',1);
	$pdf->Cell(55,6,$concepto,1,0,'L',1);
	$pdf->SetFont('courier',$negra,8);
	if($Total_Pagado > 1){$pdf->Cell(25,6,number_format($Total_Pagado,2),1,0,'R',1);}
	else
	{$pdf->Cell(25,6,'',1,0,'R',1);}
	
	
	$pdf->Cell(25,6,$Imp_orden,1,0,'R',1);
	$pdf->Cell(25,6,$IMP3,1,0,'R',1);
	
	$pdf->Cell(35,6,$est,1,0,'R',1);
	
	
	
	
  //  $pdf->Cell(35,6,$concepto,1,0,'L',1);
	
	
	
    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
}

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


$pdf->Output();
 
?>
