<?php
     error_reporting ( E_ERROR );
   	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    //include('conexion/extras.php')
 	
	
	
	 
	///////////////////////////////////////////////////////
   
	  //$cuit=$_GET['dato'];
	  $y=$_GET['consul'];
	   $yea=$y-1;
	  $nom=$_GET['nom'];
	 // $nro_s=trim($_GET['saf']);
      $ej_a=$_GET['ban']; 

	///////////////////
	
	$f=strftime("%Y-%m-%d");
    $dia = date("d/m/Y");
    $hora =date("h:i");
    $diaa = date("d-m-Y");
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

 if($ej_a=='EA')
   { 
       $_pagi_sql = "SELECT * FROM op_pendientes 
				              where (Numero_OP='$nom' or cuit ='$nom' )
							  and Ejercicio ='$yea'
							 
							  order by Ejercicio Desc,Fecha_OP DESC,Numero_OP DESC ";
							  
				 if (!($_pagi_result= mysql_query($_pagi_sql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}		
		$cant = mysql_num_rows($_pagi_result); 
		
		
		$_pagi_sql_sp = "SELECT SUM(Saldos) as Saldos,SUM(Imp_orden) as Imp_orden,SUM(Total_Pagado) as Total_Pagado FROM op_pendientes 
				              where (Numero_OP='$nom' or cuit ='$nom' )
							  and Ejercicio ='$yea'
							  and estado='N'
							
							   order by Ejercicio,Fecha_OP DESC,Numero_OP DESC ";
							  
				 if (!($_pagi_result_sp= mysql_query($_pagi_sql_sp, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}		
		$f_ordenes_sp= mysql_fetch_array ($_pagi_result_sp);
		
		
	   $importe=$f_ordenes_sp['Total_Pagado'];
	   $total=$f_ordenes_sp['Imp_orden'];
	   $saldo=$f_ordenes_sp['Saldos'];
   
		
		
   }
   else
   {
	  
	$_pagi_sql = "SELECT * FROM op_pendientes 
				              where (Numero_OP='$nom' or cuit ='$nom' )
							  and Ejercicio='$y'
							 
							   order by Ejercicio,Fecha_OP DESC,Numero_OP DESC ";
							  
				 if (!($_pagi_result= mysql_query($_pagi_sql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}		
		$cant = mysql_num_rows($_pagi_result);   
		
		
		$_pagi_sql_sp = "SELECT SUM(Saldos) as Saldos,SUM(Imp_orden) as Imp_orden,SUM(Total_Pagado) as Total_Pagado FROM op_pendientes 
				              where (Numero_OP='$nom' or cuit ='$nom' )
							  and Ejercicio='$y'
							  and estado='N'
							 
							   order by Ejercicio,Fecha_OP DESC,Numero_OP DESC ";
							  
				 if (!($_pagi_result_sp= mysql_query($_pagi_sql_sp, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}		
		$f_ordenes_sp= mysql_fetch_array ($_pagi_result_sp);
		
		
	   $importe=$f_ordenes_sp['Total_Pagado'];
	   $total=$f_ordenes_sp['Imp_orden'];
	   $saldo=$f_ordenes_sp['Saldos'];
   
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

	if ($cant>0)
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
$pdf->Image('../img/membrete1.jpg',0,0,0);
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

$pdf->SetFont('Arial','IB',12);
$pdf->setY(25);
$pdf->cell(0,0,'LISTADO DE CONSULTA FONDOS DE TESORO',0,'B','C',0);
$pdf->SetFont('Arial','IB',7);
$pdf->setY(35);
 if($ej_a=='EA')
  {
   $pdf->cell(0,0,'ORDENES PENDIENTE DE PAGO EJERCICIOS ANTERIORES',0,'B','C',0);
  }
 else
 
   {
   $pdf->cell(0,0,'ORDENES PENDIENTE DE PAGO EJERCICIO '.$y,0,'B','C',0);
  }

$y_axis_initial = 45;

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',6);
$pdf->SetY($y_axis_initial);
$pdf->SetX(15);
$pdf->Cell(8,7,'Nº',1,0,'C',1);
$pdf->Cell(12,7,'Ejercicio',1,0,'C',1);
$pdf->Cell(10,7,'Saf',1,0,'C',1);

$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
$pdf->Cell(60,7,'Beneficiarios',1,0,'C',1);
$pdf->Cell(60,7,'Concepto',1,0,'C',1);
$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);
$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);

$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
$pdf->Cell(20,7,'Observacion',1,0,'C',1);


$i = 0;

//Set maximum rows per page
$max = 18;
$y_axis=45;
//Set Row Height
$row_height = 7;
$cont=0;




while($f_ordenes= mysql_fetch_array ($_pagi_result))
{
	$est='';
			   
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
			$pdf->Image('../img/membrete1.jpg',0,0,0);
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
			$pdf->SetFont('Arial','IB',12);
			$pdf->setY(25);
			$pdf->cell(0,0,'LISTADO DE CONSULTA FONDOS  DE TESORO',0,'B','C',0);
			$pdf->SetFont('Arial','IB',7);
			$pdf->setY(35);
			if($ej_a=='EA')
  {
   $pdf->cell(0,0,'ORDENES PENDIENTE DE PAGO EJERCICIOS ANTERIORES',0,'B','C',0);
  }
 else
 
   {
   $pdf->cell(0,0,'ORDENES PENDIENTE DE PAGO EJERCICIO '.$y,0,'B','C',0);
  }


			
			
			$y_axis_initial = 45;
						
			$pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',6);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(15);
			$pdf->Cell(8,7,'Nº',1,0,'C',1);
			$pdf->Cell(12,7,'Ejercicio',1,0,'C',1);
			$pdf->Cell(10,7,'Saf',1,0,'C',1);
			$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
			$pdf->Cell(60,7,'Beneficiarios',1,0,'C',1);
			$pdf->Cell(60,7,'Concepto',1,0,'C',1);
			
			$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
			$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
			$pdf->Cell(20,7,'Observacion',1,0,'C',1);
						
			$i = 0;
			
			//Set maximum rows per page
			$max = 18;
			$y_axis=45;
			//Set Row Height
			$row_height = 7;
			 $cantp=0;

        //Set $i variable to 0 (first row)
        
    }
	elseif($cantp>0)
	 {
		    $cantp=0;
					   $pdf->SetFont('Arial','IB',7);

			$pdf->SetY($y_axis=$y_axis+10);

		   if($ej_a=='EA')
  {
   $pdf->cell(0,0,'ORDENES PENDIENTE DE PAGO EJERCICIOS ANTERIORES',0,'B','C',0);
  }
 else
 
   {
   $pdf->cell(0,0,'ORDENES PENDIENTE DE PAGO EJERCICIO '.$y,0,'B','C',0);
  }
		
			$y_axis_initial = 45;
						
			$pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',6);
				$pdf->SetY($y_axis=$y_axis+7);

			$pdf->SetX(15);
			$pdf->Cell(8,7,'Nº',1,0,'C',1);
			$pdf->Cell(12,7,'Ejercicio',1,0,'C',1);
			$pdf->Cell(10,7,'Saf',1,0,'C',1);
			$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
			$pdf->Cell(60,7,'Beneficiarios',1,0,'C',1);
			$pdf->Cell(60,7,'Concepto',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);

			$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
			$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
			$pdf->Cell(20,7,'Observacion',1,0,'C',1);
						
             $i=$i+2;
	 }

        // $ejer = $f_ordenp['Ejercicio']; 
		
	  
	  
	   $fecha=$f_ordenes['Fecha_OP'];
       $saf=$f_ordenes['Saf'];
       $orden_pago=$f_ordenes['Numero_OP'];
	   $sal_disp=$f_ordenes['Saldos'];
	   $imp_form=$f_ordenes['Imp_orden'];
	   $imp_pag=$f_ordenes['Total_Pagado'];
	   $benef=substr($f_ordenes['Beneficiario'],0,40);
	   $concepto=substr($f_ordenes['Concepto'],0,40);
	   $estado_op=$f_ordenes['estado'];
	    $d_cuit=$f_ordenes['cuit'];
		 $ejer = $f_ordenes['Ejercicio']; 
	  
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
		   $apellido_b=$f_cb['apellido'];
		   $nombre_b=$f_cb['nombre'];
		   $razon_social_b=$f_cb['razon_social'];
		   $inhi=$f_cb['inhi'];
		   
		   if($razon_social_b=='')
		     {
				 $beneficiario=$apellido_b.', '.$nombre_b;
			 }
			else
			 {
				  $beneficiario=$razon_social_b;
			 }
		     
   if($inhi!=''){ $est='BENC';}
	        if($estado_ben=='B'){ $est='BENB';}		 
             
	    $f_g=explode("-",$f_ordenes['Fecha_OP']); 
	    $fecha_ing=$f_g[2].'-'.$f_g[1].'-'.$f_g[0]; 
		 
	   $resultado_resta = restaFechas($fecha_ing,$diaa);
	//   if ($estado=='P'){$est='';}
		  if ($estado=='B'){$est='BLOR';}
		  if ($estado=='A'){$est='BAJR';}
		  if ($estado=='I'){$est='IMP';}
		 if($resultado_resta >365 ){$est='BAJD';} 
	   
	   
	$pdf->SetFont('courier',$negra,7);
	$pdf->SetY($y_axis=$y_axis+7);
	$pdf->SetX(15);
	$cont=$cont+1;
    $pdf->Cell(8,6,$cont,1,0,'C',1); 
	$pdf->Cell(12,6,$ejer,1,0,'C',1);

	$pdf->Cell(10,6,$saf,1,0,'C',1);

	$pdf->Cell(20,6,$orden_pago,1,0,'C',1);
	$pdf->SetFont('courier',$negra,6);
    $pdf->Cell(60,6,$benef,1,0,'L',1);
	$pdf->Cell(60,6,$concepto,1,0,'L',1);
	$pdf->SetFont('courier',$negra,8);
	$pdf->Cell(25,6,$imp_form,1,0,'R',1);

	$pdf->Cell(25,6,$imp_pag,1,0,'R',1);
	$pdf->Cell(25,6,$sal_disp,1,0,'R',1);

	$pdf->Cell(20,6,$est,1,0,'R',1);
	
	
	
  //  $pdf->Cell(35,6,$concepto,1,0,'L',1);
	
	
	
    //Go to next row
   
    $i = $i + 1;

    /* $importe=$importe+$imp_pag;
	$total=$total+$imp_form;
	$saldo=$saldo+$sal_disp;
*/
    
   /*     $_pagi_sql1 = "SELECT * FROM orden_pago 
				              where orden_pago='$orden_pago' 
							   and ejercicio ='$y'
							   and saf='$saf'";
				 if (!($_pagi_result1= mysql_query($_pagi_sql1, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}			
*/
	  
	 // $cantp = mysql_num_rows($_pagi_result1);

	  
	
  if($cantp > 0)
       {
		   if (($i == $max) or($i>10))
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



            $pdf->AddPage();

			//$pdf->SetTopMargin(25);
			
			$y_axis_initial = 25;
			$y_axis=62;
			// imprime el titulo de la pagina
			$pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',11);
			$pdf->SetY($y_axis_initial);
			//$pdf->SetY(20);
			$pdf->SetFillColor(256,256,256);
			//$pdf->SetFont('Arial','I',6);
			$pdf->setY(10);
			$pdf->Image('../img/membrete1.jpg',0,0,0);
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
			
			$pdf->SetFont('Arial','IB',12);
			$pdf->setY(25);
			$pdf->cell(0,0,'LISTADO DE CONSULTA FONDOS  DE TESORO',0,'B','C',0);
			$pdf->SetFont('Arial','IB',7);
			$pdf->setY(35);
			
			$pdf->cell(0,0,'PAGOS PARCIALES',0,'B','C',0);
   
	        $pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',6);
			$pdf->SetY($y_axis=$y_axis+7);
			$pdf->SetX(15);
			$pdf->Cell(8,7,'Nº',1,0,'C',1);
			$pdf->Cell(12,7,'Ejercicio',1,0,'C',1);
			$pdf->Cell(10,7,'Saf',1,0,'C',1);
			$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
			$pdf->Cell(20,7,'Fecha de Pago',1,0,'C',1);
			$pdf->Cell(60,7,'Beneficiarios',1,0,'C',1);
			$pdf->Cell(65,7,'Concepto',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
			$pdf->Cell(20,7,'Observacion',1,0,'C',1);

 }
 else
 {
 
			$pdf->SetFont('Arial','IB',7);
			$pdf->setY($y_axis=$y_axis+10);
			$pdf->cell(0,0,'PAGOS PARCIALES',0,'B','C',0);
   
	        $pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',6);
			$pdf->SetY($y_axis=$y_axis+7);
			$pdf->SetX(15);
			$pdf->Cell(8,7,'Nº',1,0,'C',1);
			$pdf->Cell(12,7,'Ejercicio',1,0,'C',1);
			$pdf->Cell(10,7,'Saf',1,0,'C',1);
			$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
			$pdf->Cell(20,7,'Fecha de Pago',1,0,'C',1);
			$pdf->Cell(60,7,'Beneficiarios',1,0,'C',1);
			$pdf->Cell(65,7,'Concepto',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
            $pdf->Cell(20,7,'Observacion',1,0,'C',1);
			$i=$i+2;
 }
    while ($f_ordenp=mysql_fetch_array($_pagi_result1))
          {
			  
			  
			  
			  
		  $cuil = $f_ordenp['cuit'];
		  
		  $sql = "SELECT * From beneficiarios_aprobados 
				        where cuitl='$cuil'	";
				 if (!($_benef= mysql_query($sql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}
			$f_benef=mysql_fetch_array($_benef);
			
		//	$f_cb=mysql_fetch_array($r_cb);
		   
		  
		   $apellido_p=$f_benef['apellido'];
		   $nombre_p=$f_benef['nombre'];
		   $razon_social_p=$f_benef['razon_social'];
		  
		   
		   if($razon_social_p=='')
		     {
				 $beneficiario_p=$apellido_p.', '.$nombre_p;
			 }
			else
			 {
				  $beneficiario_p=$razon_social_p;
			 }
			
			$ejer = $f_ordenp['ejercicio'];
            $saf = $f_ordenp['saf'];
            $$orden_pago = $f_ordenp['orden_pago'];
            $fecha = $f_ordenp['fecha'];
			$concepto=substr($f_ordenp['concepto'],0,40);
            $total_p=$f_ordenp['total'];
			
			
		
			
			
			$pdf->SetFont('courier',$negra,7);
			$pdf->SetY($y_axis=$y_axis+7);
	$pdf->SetX(15);
	$cont=$cont+1;
    $pdf->Cell(8,6,$cont,1,0,'C',1); 
	$pdf->Cell(12,6,$ejer,1,0,'C',1);

	$pdf->Cell(10,6,$saf,1,0,'C',1);

	$pdf->Cell(20,6,$orden_pago,1,0,'C',1);
	$pdf->Cell(20,6,$fecha,1,0,'C',1);

	$pdf->SetFont('courier',$negra,6);
    $pdf->Cell(60,6,$beneficiario_p,1,0,'L',1);
	$pdf->Cell(65,6,$concepto,1,0,'L',1);
	$pdf->SetFont('courier',$negra,8);
	$pdf->Cell(25,6,$total_p,1,0,'R',1);
	$pdf->Cell(20,6,'',1,0,'R',1);
	
	
	
  //  $pdf->Cell(35,6,$concepto,1,0,'L',1);
	
	
	
    //Go to next row
   
    $i = $i + 1;

   
     }
 }
 

 }// fin de pendientes

if (($i >= 18) and ($i< $max))
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



            $pdf->AddPage();

			//$pdf->SetTopMargin(25);
			
			$y_axis_initial = 25;
			$y_axis=62;
			// imprime el titulo de la pagina
			$pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',11);
			$pdf->SetY($y_axis_initial);
			//$pdf->SetY(20);
			$pdf->SetFillColor(256,256,256);
			//$pdf->SetFont('Arial','I',6);
			$pdf->setY(10);
			$pdf->Image('../img/membrete1.jpg',0,0,0);
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
			
			$pdf->SetFont('Arial','IB',12);
			$pdf->setY(25);
			$pdf->cell(0,0,'LISTADO DE CONSULTA FONDOS  DE TESORO',0,'B','C',0);
			$pdf->SetFont('Arial','IB',7);
			$pdf->setY(35);
			if($ej_a=='EA')
  {
   $pdf->cell(0,0,'ORDENES PENDIENTE DE PAGO EJERCICIOS ANTERIORES',0,'B','C',0);
  }
 else
 
   {
   $pdf->cell(0,0,'ORDENES PENDIENTE DE PAGO EJERCICIO '.$y,0,'B','C',0);
  }


			
			
			$y_axis_initial = 45;
		    $pdf->SetFont('courier','B',7);
            $pdf->SetFillColor(256,256,256);
			$pdf->SetY($y_axis);
		    $pdf->SetX(15);   
			$pdf->Cell(120,5,'TOTAL PAGO PENDIENTE: ',0,0,'R',1);
			$pdf->Cell(75,5,number_format($total,2),0,0,'R',1);
			$pdf->Cell(25,5,number_format($importe,2),0,0,'R',1);
			$pdf->Cell(25,5,number_format($saldo,2),0,0,'R',1);
			$pdf->SetY($y_axis=$y_axis+5);
			$pdf->SetX(15);
			$pdf->Cell(265,4,'','T',0,'L',1);
			$i = 0;
			
			//Set maximum rows per page
			$max = 18;
			$y_axis=45;
			//Set Row Height
			$row_height = 7;


 }
else
  {
	        $pdf->SetFont('courier','B',7);
            $pdf->SetFillColor(256,256,256);
			$pdf->SetY($y_axis=$y_axis+7);
		    $pdf->SetX(15);   
		$pdf->Cell(120,5,'TOTAL PAGO PENDIENTE: ',0,0,'R',1);
			$pdf->Cell(75,5,number_format($total,2),0,0,'R',1);
			$pdf->Cell(25,5,number_format($importe,2),0,0,'R',1);
		$pdf->Cell(25,5,number_format($saldo,2),0,0,'R',1);
		$pdf->SetY($y_axis=$y_axis+5);
        $pdf->SetX(15);
        $pdf->Cell(265,4,'','T',0,'L',1);
		 $i = $i + 2;
			
  }

 }
 $cont=0;
	if($ej_a=='EA')
   {   
        $_pagi_sql1 = "SELECT ejercicio, o.saf, orden_pago, fecha, apellido, nombre, razon_social, concepto, total
FROM orden_pago AS o, beneficiarios_aprobados AS b
				              where (orden_pago='$nom' or cuit ='$nom') 
							      and cuitl=cuit
								 
							      and ejercicio ='$yea' ORDER BY fecha DESC ";
				 if (!($_pagi_resultp= mysql_query($_pagi_sql1, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}			
 
 
      $cant_p = mysql_num_rows($_pagi_resultp);
	  
	  
	   $_pagi_sql = "SELECT sum(total) AS TOTAL_PAGO
FROM orden_pago AS o, beneficiarios_aprobados AS b
				              where (orden_pago='$nom' or cuit ='$nom') 
							      and cuitl=cuit
								  
							      and ejercicio ='$yea' ORDER BY fecha DESC ";
				 if (!($_pagi_pago= mysql_query($_pagi_sql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}			
 
 
       $f_ord=mysql_fetch_array($_pagi_pago);
				  $tota_pago=$f_ord['TOTAL_PAGO'];
	  
	  
	  
	  
 $aux=0;
   }
   else
   {
	       $_pagi_sql1 = "SELECT ejercicio, o.saf, orden_pago, fecha, apellido, nombre, razon_social, concepto, total
FROM orden_pago AS o, beneficiarios_aprobados AS b
				              where (orden_pago='$nom' or cuit ='$nom') 
							      and cuitl=cuit
								 
							      and ejercicio ='$y' ORDER BY fecha DESC ";
				 if (!($_pagi_resultp= mysql_query($_pagi_sql1, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}			
 
 
      $cant_p = mysql_num_rows($_pagi_resultp);
	  
	   $_pagi_sql = "SELECT sum(total) AS TOTAL_PAGO
FROM orden_pago AS o, beneficiarios_aprobados AS b
				              where (orden_pago='$nom' or cuit ='$nom') 
							      and cuitl=cuit
								 
							      and ejercicio ='$y' ORDER BY fecha DESC ";
				 if (!($_pagi_pago= mysql_query($_pagi_sql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}	
 $aux=0;
                  $f_ord=mysql_fetch_array($_pagi_pago);
				  $tota_pago=$f_ord['TOTAL_PAGO'];
				 
   }

if (($i >= 18) and ($i< $max)) 			{
				$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','IB',8);
 //Print current and total page numbers
$pdf->Cell(0,4,'REFERENCIA: ',0,0,'L');
 $pdf->SetY(-10);
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
			
			$pdf->SetFont('Arial','IB',12);
			$pdf->setY(25);
			$pdf->cell(0,0,'LISTADO DE CONSULTA FONDOS  DE TESORO',0,'B','C',0);
			$pdf->SetFont('Arial','IB',7);
			$pdf->setY(35);
			if($ej_a=='EA')
  {
   $pdf->cell(0,0,'ORDENES PAGADAS EJERCICIOS ANTERIORES',0,'B','C',0);
  }
 else
 
   {
   $pdf->cell(0,0,'ORDENES PAGADAS EJERCICIO '.$y,0,'B','C',0);
  }
			
			



			
			
			$y_axis_initial = 45;
			
		
   
	        $pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',6);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(15);
			$pdf->Cell(8,7,'Nº',1,0,'C',1);
			$pdf->Cell(12,7,'Ejercicio',1,0,'C',1);
			$pdf->Cell(10,7,'Saf',1,0,'C',1);
			$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
			$pdf->Cell(20,7,'Fecha de Orden',1,0,'C',1);
			$pdf->Cell(60,7,'Beneficiarios',1,0,'C',1);
			$pdf->Cell(65,7,'Concepto',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
			$pdf->Cell(20,7,'Observacion',1,0,'C',1);
						
			$i = 0;
			
			//Set maximum rows per page
			$max = 18;
			$y_axis=45;
			//Set Row Height
			$row_height = 7;
			
			}
	else
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
			
			$pdf->SetFont('Arial','IB',12);
			$pdf->setY(25);
			$pdf->cell(0,0,'LISTADO DE CONSULTA FONDOS  DE TESORO',0,'B','C',0);
			$pdf->SetFont('Arial','IB',7);
			$pdf->setY(35);
			if($ej_a=='EA')
  {
   $pdf->cell(0,0,'ORDENES PAGADAS EJERCICIOS ANTERIORES',0,'B','C',0);
  }
 else
 
   {
   $pdf->cell(0,0,'ORDENES PAGADAS EJERCICIO '.$y,0,'B','C',0);
  }
			
			



			
			
			$y_axis_initial = 45;
			
		
   
	        $pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',6);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(15);
			$pdf->Cell(8,7,'Nº',1,0,'C',1);
			$pdf->Cell(12,7,'Ejercicio',1,0,'C',1);
			$pdf->Cell(10,7,'Saf',1,0,'C',1);
			$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
			$pdf->Cell(20,7,'Fecha de Orden',1,0,'C',1);
			$pdf->Cell(60,7,'Beneficiarios',1,0,'C',1);
			$pdf->Cell(65,7,'Concepto',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
			$pdf->Cell(20,7,'Observacion',1,0,'C',1);
						
			$i = 0;
			
			//Set maximum rows per page
			$max = 18;
			$y_axis=45;
			//Set Row Height
			$row_height = 7;
					
	}
 if($cant_p > 0)
    {
   while ($f_ord=mysql_fetch_array($_pagi_resultp))
	  {
		  
		  if (($i == $max) or ($i>18) ) 
			{
				$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','IB',8);
 //Print current and total page numbers
$pdf->Cell(0,4,'REFERENCIA: ',0,0,'L');
 $pdf->SetY(-10);
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
			$pdf->Image('../img/membrete1.jpg',0,0,0);
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
			
			$pdf->SetFont('Arial','IB',12);
			$pdf->setY(25);
			$pdf->cell(0,0,'LISTADO DE CONSULTA FONDOS  DE TESORO',0,'B','C',0);
			$pdf->SetFont('Arial','IB',7);
			$pdf->setY(35);
			if($ej_a=='EA')
  {
   $pdf->cell(0,0,'ORDENES PAGADAS EJERCICIOS ANTERIORES',0,'B','C',0);
  }
 else
 
   {
   $pdf->cell(0,0,'ORDENES PAGADAS EJERCICIO '.$y,0,'B','C',0);
  }
			
			
			
			$y_axis_initial = 45;
			
			
   
	        $pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',6);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(15);
			$pdf->Cell(8,7,'Nº',1,0,'C',1);
			$pdf->Cell(12,7,'Ejercicio',1,0,'C',1);
			$pdf->Cell(10,7,'Saf',1,0,'C',1);
			$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
			$pdf->Cell(20,7,'Fecha de Pago',1,0,'C',1);
   		    $pdf->Cell(60,7,'Beneficiarios',1,0,'C',1);
			$pdf->Cell(65,7,'Concepto',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
			$pdf->Cell(20,7,'Observacion',1,0,'C',1);
						
			$i = 0;
			
			//Set maximum rows per page
			$max = 18;
			$y_axis=45;
			//Set Row Height
			$row_height = 7;
			}
          $apellido_a = $f_ord['apellido'];
		  $nombre_a = $f_ord['nombre'];
		  $razon_social_a = $f_ord['razon_social'];
        if($razon_social_a=='')
		     {
				 $beneficiario_a=$apellido_a.', '.$nombre_a;
			 }
			else
			 {
				  $beneficiario_a=$razon_social_a;
			 }
			
			$ejer = $f_ord['ejercicio'];
            $saf = $f_ord['saf'];
            $orden_pago = $f_ord['orden_pago'];
            $fecha = $f_ord['fecha'];
			$concepto=substr($f_ord['concepto'],0,40);
            $total_p=$f_ord['total'];
			
			
		if($aux==0){$aux_saf=$saf; $aux_ejer=$ejer ; $aux=1;  $pago_total=$pago_total+$total_p; }
		
		else{
			
			if($aux_saf==$saf and $aux_ejer==$ejer)
			      {
				   $pago_total=$pago_total+$total_p;  	  
				  }
			   
			else
			    {
			
			$pago_total=0;
			$aux_saf=$saf;
			$aux_ejer=$ejer;
			 $pago_total=$pago_total+$total_p; 
				}
			
			
			 }
		
			
			
			$pdf->SetFont('courier',$negra,7);
			$pdf->setY($y_axis=$y_axis+7);
	$pdf->SetX(15);
	$cont=$cont+1;
    $pdf->Cell(8,6,$cont,1,0,'C',1); 
	$pdf->Cell(12,6,$ejer,1,0,'C',1);

	$pdf->Cell(10,6,$saf,1,0,'C',1);

	$pdf->Cell(20,6,$orden_pago,1,0,'C',1);
		$pdf->Cell(20,6,$fecha,1,0,'C',1);

	$pdf->SetFont('courier',$negra,6);
    $pdf->Cell(60,6,$beneficiario_a,1,0,'L',1);
	$pdf->Cell(65,6,$concepto,1,0,'L',1);
	$pdf->SetFont('courier',$negra,8);
	$pdf->Cell(25,6,$total_p,1,0,'R',1);
	$pdf->Cell(20,6,'',1,0,'R',1);
	
	
	
  //  $pdf->Cell(35,6,$concepto,1,0,'L',1);
	
	
	
    //Go to next row
    $i = $i + 1;

  


	  }
	
if (($i == $max) or($i>18))
 {

$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','IB',8);
 //Print current and total page numbers
$pdf->Cell(0,4,'REFERENCIA: ',0,0,'L');
 $pdf->SetY(-10);
//Select Arial italic 8
$pdf->SetFont('Arial','I',6);
 //Print current and total page numbers

$pdf->MultiCell(0,4,'BAJR: Baja/Retenciones  -  BLOR: Bloqueo/Retenciones - IMP: Control de Impuesto - BAJAD: Baja - Dec 1804/10 + 365 dias  - BENB: Beneficiario Inhabilitado  -  BENC: Cuenta Cerrada',1,'J',0,8);
	

$pdf->SetY(-8);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');



            $pdf->AddPage();

			//$pdf->SetTopMargin(25);
			
			$y_axis_initial = 25;
			$y_axis=62;
			// imprime el titulo de la pagina
			$pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',11);
			$pdf->SetY($y_axis_initial);
			//$pdf->SetY(20);
			$pdf->SetFillColor(256,256,256);
			//$pdf->SetFont('Arial','I',6);
			$pdf->setY(10);
			$pdf->Image('../img/membrete1.jpg',0,0,0);
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
			
			$pdf->SetFont('Arial','IB',12);
			$pdf->setY(25);
			$pdf->cell(0,0,'LISTADO DE CONSULTA FONDOS  DE TESORO',0,'B','C',0);
			$pdf->SetFont('Arial','IB',7);
			$pdf->setY(35);
			if($ej_a=='EA')
  {
   $pdf->cell(0,0,'ORDENES PAGADAS EJERCICIOS ANTERIORES',0,'B','C',0);
  }
 else
 
   {
   $pdf->cell(0,0,'ORDENES PAGADAS EJERCICIO '.$y,0,'B','C',0);
  }
			

			
			
			$y_axis_initial = 45;
		    $pdf->SetFont('courier','B',7);
            $pdf->SetFillColor(256,256,256);
			$pdf->SetY($y_axis);
		    $pdf->SetX(15);   
			$pdf->Cell(120,5,'TOTAL PAGADO: ',0,0,'R',1);
			$pdf->Cell(100,5,number_format($tota_pago,2),0,0,'R',1);
			
			$pdf->SetY($y_axis=$y_axis+5);
			$pdf->SetX(15);
			$pdf->Cell(240,4,'','T',0,'L',1);
			$i = 0;
			
			//Set maximum rows per page
			$max = 18;
			$y_axis=45;
			//Set Row Height
			$row_height = 7;


 }
else
  {
	        $pdf->SetFont('courier','B',7);
            $pdf->SetFillColor(256,256,256);
			$pdf->SetY($y_axis=$y_axis+7);
		    $pdf->SetX(15);   
		$pdf->Cell(120,5,'TOTAL PAGADO : ',0,0,'R',1);
		$pdf->Cell(100,5,number_format($tota_pago,2),0,0,'R',1);
		
		$pdf->SetY($y_axis=$y_axis+5);
        $pdf->SetX(15);
        $pdf->Cell(240,4,'','T',0,'L',1);
		 $i = $i + 2;
			
  }




	}
	
	
	
$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','IB',8);
 //Print current and total page numbers
$pdf->Cell(0,4,'REFERENCIA: ',0,0,'L');
 $pdf->SetY(-10);
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
