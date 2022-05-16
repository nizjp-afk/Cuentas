<?php
    
   error_reporting ( E_ERROR );
	 include('../dgti-mysql-var_dbtgp.php');
    include('../dgti-intranet-mysql_connect.php');  
	include('../dgti-intranet-mysql_select_db.php');
    //include('conexion/extras.php');
 	
	///////////////////////////////////////////////////////
    $diaa = date("d-m-Y");
	$cuit=$_GET['dato'];
	$fecha_cons=$_GET['consul'];
	$cuit=$_GET['cuit'];
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
/////////////////////////////
$ee=date('Y')-2;	
 
 $fecha = date('Y-m-d');
$nuevafecha = strtotime ( '-1 year' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
  
		 $_pagi_sql = "SELECT *, (IMP_FORM - RETENCION - IMPORTE_A_PAGAR) AS pagado, (IMP_FORM - RETENCION )as Imp_orden  FROM orden_pago
				              where  CUIT ='$cuit' 
							  and ESTADO!='C'
							  
							  and Fecha_OP > '2015-04-01'
							  and Fecha_OP > '$nuevafecha'
							   and id_escritural  in  ('158','159','160','161','162','163','164','165','166','167','168','169','170','171','172','173','174','175','176','177','178','179','180','181','182','183','184','185','186','187','188','189','190','191','192','193','194','195','197')
							  order by ejercicio DESC,Fecha_OP desc,ESTADO DESC  ";
							  
		
			 if (!($ordenes= mysql_query($_pagi_sql, $conexion_mysql)))
			{
			
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes";
			  echo $cuerpo1;
			  //.....................................................................
			}  
    include('../dgti-mysql-var_dbtgp.php');
    include('../dgti-intranet-mysql_connect.php');  
	include('../dgti-intranet-mysql_select_db.php');


  $_pagi_sql = "SELECT *, (IMP_FORM - RETENCION - IMPORTE_A_PAGAR) AS pagado, (IMP_FORM - RETENCION )as Imp_orden  FROM orden_pago
				              where  CUIT ='$cuit' 
							  and ESTADO!='C'
							   and Fecha_OP > '$nuevafecha'
							  and Fecha_OP > '2015-04-01'
							   and id_escritural not in  ('158','159','160','161','162','163','164','165','166','167','168','169','170','171','172','173','174','175','176','177','178','179','180','181','182','183','184','185','186','187','188','189','190','191','192','193','194','195','197')
							  order by ejercicio DESC,Fecha_OP desc,ESTADO DESC ";



						  
		
			 if (!($ordenes_fp= mysql_query($_pagi_sql, $conexion_mysql)))
			{
			
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes";
			  echo $cuerpo1;
			  //.....................................................................
			}  
			
$cant = mysql_num_rows($ordenes);  
$cant1 = mysql_num_rows($ordenes_fp);   			
						  
			

	
	


  
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
$pdf->cell(0,0,'LISTADO DE ORDENES DE PAGO PENDIENTES FUENTE DE TESORO',0,'B','C',0);


$y_axis_initial = 55;

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',6);
$pdf->SetY($y_axis_initial);
$pdf->SetX(5);
$pdf->Cell(10,7,'Nº',1,0,'C',1);
$pdf->Cell(10,7,'Ejercicio',1,0,'C',1);
$pdf->Cell(10,7,'Saf',1,0,'C',1);
$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
$pdf->Cell(65,7,'Beneficiarios',1,0,'C',1);
$pdf->Cell(85,7,'Concepto',1,0,'C',1);

//$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);
	$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
			$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
			$pdf->Cell(15,7,'Observacion',1,0,'C',1);








$i = 0;

//Set maximum rows per page
$max = 18;
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
			//$pdf->SetTopMargin(25);
			 $pdf->AddPage();
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
			$pdf->cell(0,0,'LISTADO DE ORDENES DE PAGO PENDIENTES FUENTE DE TESORO',0,'B','C',0);
			
			
			$y_axis_initial = 55;
			
			$pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',6);
			$pdf->SetY($y_axis_initial);
		
			$pdf->SetX(5);
			$pdf->Cell(10,7,'Nº',1,0,'C',1);
			$pdf->Cell(10,7,'Ejercicio',1,0,'C',1);
			$pdf->Cell(10,7,'Saf',1,0,'C',1);
			$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);

			$pdf->Cell(65,7,'Beneficiarios',1,0,'C',1);
			$pdf->Cell(85,7,'Concepto',1,0,'C',1);
			
			
			$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
			$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
			$pdf->Cell(15,7,'Observacion',1,0,'C',1);
						
			$i = 0;
			
			//Set maximum rows per page
			$max = 18;
			$y_axis=62;
			//Set Row Height
			$row_height = 7;
			

        //Set $i variable to 0 (first row)
        
    }
	
	
	
	   $fecha=$f_ordenes['Fecha_OP'];
       $saf=$f_ordenes['SAF'];
	   $ejercicio=$f_ordenes['EJERCICIO'];
	   
	     $orden=$f_ordenes['NUMERO'];
		 $num=$f_ordenes['FORMULARIO']; 
		 $saf_op = $f_ordenes['SAF'];   
		 
		  $f_g=explode("-",$f_ordenes['FECHA_OP']); 
	      $fecha_ing=$f_g[2].'-'.$f_g[1].'-'.$f_g[0]; 
		  $valor=''; 
		   $resultado_resta = restaFechas($fecha_ing,$dia);
	   
       $orden_pago=$num.'-'.$saf_op.'-'.$orden;
	   
	   $estado_op=$f_ordenes['ESTADO'];
		  $IMP1= number_format($f_ordenes['IMP_FORM'],2);
	   $IMP2=number_format($f_ordenes['RETENCION'],2);
	   $IMP3=number_format($f_ordenes['IMPORTE_A_PAGAR'],2);
	   $Imp_orden=number_format($f_ordenes['Imp_orden'],2);
       $Total_Pagado=number_format($f_ordenes['pagado']);
	   
	   
	      if ($estado_op=='P'){$valor='';}
		  if ($estado_op=='B'){$valor='BLOR';}
		  if ($estado_op=='A'){$valor='BAJR';}
		  if ($estado_op=='I'){$valor='IMP';}
		
	 
	  
	   $benef=substr($f_ordenes['BENEFICIARIO'],0,40);
	  
	   $concepto=substr($f_ordenes['CONCEPTO'],0,100);
	 
	

	   
    
	  
	
	  
	    
	 //  $concepto=substr($f_ordenes['Concepto'],0,15);
	    
		 $f_g=explode("-",$f_ordenes['Fecha_OP']); 
	    $fecha_ing=$f_g[2].'-'.$f_g[1].'-'.$f_g[0]; 
		  $valor=''; 
		//   $resultado_resta = restaFechas($fecha_ing,$dia);
	     
	
	//	 if($resultado_resta >365 ){$valor='BAJD';} 
	
	
	  
	   
	$pdf->SetFont('courier',$negra,6);
	$pdf->SetY($y_axis);
	$pdf->SetX(5);
	$cont=$cont+1;
    $pdf->Cell(10,6,$cont,1,0,'C',1); 
	   $pdf->Cell(10,6,$ejercicio,1,0,'C',1); 
	      $pdf->Cell(10,6,$saf,1,0,'C',1); 
	$pdf->Cell(20,6,$orden_pago,1,0,'C',1);
	$pdf->SetFont('courier',$negra,6);
    $pdf->Cell(65,6,$benef,1,0,'L',1);
	$pdf->Cell(85,6,$concepto,1,0,'L',1);
	$pdf->SetFont('courier',$negra,8);
	
	$pdf->Cell(25,6,$Imp_orden ,1,0,'R',1);
		$pdf->Cell(25,6,$Total_Pagado ,1,0,'R',1);
	$pdf->Cell(25,6,$IMP3,1,0,'R',1);
	$pdf->SetFont('courier',$negra,7);
	$pdf->Cell(15,6,$valor,1,0,'R',1);
	
	
	
	
  //  $pdf->Cell(35,6,$concepto,1,0,'L',1);
	
	
	
    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
}



///////////////////
//	BAJA-Dec 1804/10 + 365 dias

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
 }
if($cant1>0)
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
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
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
$pdf->cell(0,0,'LISTADO DE ORDENES DE PAGO PENDIENTES FONDOS PROPIOS ',0,'B','C',0);


$y_axis_initial = 55;

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',6);
$pdf->SetY($y_axis_initial);
$pdf->SetX(5);
$pdf->Cell(10,7,'Nº',1,0,'C',1);
$pdf->Cell(10,7,'Ejercicio',1,0,'C',1);
$pdf->Cell(10,7,'Saf',1,0,'C',1);

$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);

$pdf->Cell(65,7,'Beneficiarios',1,0,'C',1);
$pdf->Cell(85,7,'Concepto',1,0,'C',1);
//$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);
$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
$pdf->Cell(15,7,'Observacion',1,0,'C',1);








$i = 0;

//Set maximum rows per page
$max = 18;
$y_axis=62;
//Set Row Height
$row_height = 7;
$cont=0;

while($f_ordenes= mysql_fetch_array ($ordenes_fp))
{
			   
			//If the current row is the last one, create new page and print column title
			if ($i == $max)
			{
							//Add first page
		   
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
			//$pdf->SetTopMargin(25);
			 $pdf->AddPage();
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
			$pdf->cell(0,0,'LISTADO DE ORDENES DE PAGO PENDIENTES FONDOS PROPIOS',0,'B','C',0);
			
			
			$y_axis_initial = 55;
			
			$pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',6);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(5);
			$pdf->Cell(10,7,'Nº',1,0,'C',1);
			$pdf->Cell(10,7,'Ejercicio',1,0,'C',1);
			$pdf->Cell(10,7,'Saf',1,0,'C',1);
			$pdf->Cell(65,7,'Beneficiarios',1,0,'C',1);
			$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);

			$pdf->Cell(85,7,'Concepto',1,0,'C',1);
			
			$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
			$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
			$pdf->Cell(15,7,'Observacion',1,0,'C',1);
						
			$i = 0;
			
			//Set maximum rows per page
			$max = 18;
			$y_axis=62;
			//Set Row Height
			$row_height = 7;
			

        //Set $i variable to 0 (first row)
        
    }

       $fecha=$f_ordenes['Fecha_OP'];
       $saf=$f_ordenes['SAF'];
	   $ejercicio=$f_ordenes['EJERCICIO'];
	   
	     $orden=$f_ordenes['NUMERO'];
		 $num=$f_ordenes['FORMULARIO']; 
		 $saf_op = $f_ordenes['SAF'];   
		 
		  $f_g=explode("-",$f_ordenes['FECHA_OP']); 
	      $fecha_ing=$f_g[2].'-'.$f_g[1].'-'.$f_g[0]; 
		  $valor=''; 
		   $resultado_resta = restaFechas($fecha_ing,$dia);
	   
       $orden_pago=$num.'-'.$saf_op.'-'.$orden;
	   
	   $estado_op=$f_ordenes['ESTADO'];
		
	   $IMP1= number_format($f_ordenes['IMP_FORM'],2);
	   $IMP2=number_format($f_ordenes['RETENCION'],2);
	   $IMP3=number_format($f_ordenes['IMPORTE_A_PAGAR'],2);
	   $Imp_orden=number_format($f_ordenes['Imp_orden'],2);
       $Total_Pagado=number_format($f_ordenes['pagado']);
	   
	   
	      if ($estado_op=='P'){$valor='';}
		  if ($estado_op=='B'){$valor='BLOR';}
		  if ($estado_op=='A'){$valor='BAJR';}
		  if ($estado_op=='I'){$valor='IMP';}
		 if($resultado_resta >365 ){$valor='BAJD';} 
	 
	  
	   $benef=substr($f_ordenes['BENEFICIARIO'],0,40);
	  
	   $concepto=substr($f_ordenes['CONCEPTO'],0,100);
	 
	 
	 //  $concepto=substr($f_ordenes['Concepto'],0,15);
	  
	   
	   
	   
	$pdf->SetFont('courier',$negra,6);
	$pdf->SetY($y_axis);
	$pdf->SetX(5);
	$cont=$cont+1;
    $pdf->Cell(10,6,$cont,1,0,'C',1); 
	   $pdf->Cell(10,6,$ejercicio,1,0,'C',1); 
	    $pdf->Cell(10,6,$saf,1,0,'C',1); 
	$pdf->Cell(20,6,$orden_pago,1,0,'C',1);
	$pdf->SetFont('courier',$negra,6);
    $pdf->Cell(65,6,$benef,1,0,'L',1);
	$pdf->Cell(85,6,$concepto,1,0,'L',1);
	$pdf->SetFont('courier',$negra,8);
	
	$pdf->Cell(25,6,$Imp_orden ,1,0,'R',1);
	$pdf->Cell(25,6,$Total_Pagado ,1,0,'R',1);
	$pdf->Cell(25,6,$IMP3,1,0,'R',1);
	$pdf->SetFont('courier',$negra,7);
	$pdf->Cell(15,6,$valor,1,0,'R',1);
	
	
	
	
  //  $pdf->Cell(35,6,$concepto,1,0,'L',1);
	
	
	
    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
}




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
 }

$pdf->AliasNbPages();

//////// fin Formacion ACademica
$pdf->Output();
 
?>
