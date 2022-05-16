<?php
    
   	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    //include('conexion/extras.php')
 	
	///////////////////////////////////////////////////////
   
	  //$cuit=$_GET['dato'];
	  $fecha_cons=$_GET['consul'];
	 
	  $nom=$_GET['nom'];
	///////////////////
	
	$f=strftime("%Y-%m-%d");
    $dia = date("d/m/Y");
    $hora =date("h:i");
   
   ////////////////////////////

       $_pagi_sql = "SELECT * FROM op_pendientes_r 
				              where (Numero_OP='$nom' or cuit ='$nom' )
							   order by Ejercicio ";
							  
				 if (!($_pagi_result= mysql_query($_pagi_sql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}		
		$cant = mysql_num_rows($_pagi_result); 
		
		

		
		
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

$pdf->SetFont('Arial','IB',7);
$pdf->setY(25);
$pdf->cell(0,0,'LISTADO DE CONSULTA',0,'B','C',0);
$pdf->setY(35);
$pdf->cell(0,0,'ORDENES PENDIENTE DE PAGO',0,'B','C',0);


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
$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);
$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
$pdf->Cell(20,7,'Observacion',1,0,'C',1);


$i = 0;

//Set maximum rows per page
$max = 20;
$y_axis=45;
//Set Row Height
$row_height = 7;
$cont=0;




while($f_ordenes= mysql_fetch_array ($_pagi_result))
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
		   $pdf->SetFont('Arial','IB',7);
			$pdf->setY(25);
			$pdf->cell(0,0,'LISTADO DE CONSULTA',0,'B','C',0);
			$pdf->setY(35);
			$pdf->cell(0,0,'ORDENES PENDIENTE DE PAGO',0,'B','C',0);


			
			
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
			$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);
			$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
			$pdf->Cell(20,7,'Observacion',1,0,'C',1);
						
			$i = 0;
			
			//Set maximum rows per page
			$max = 20;
			$y_axis=60;
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

		    $pdf->cell(0,0,'ORDENES PENDIENTE DE PAGO',0,'B','C',0);
		
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
			$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Form',1,0,'C',1);
			$pdf->Cell(25,7,'Saldos Disp',1,0,'C',1);
			$pdf->Cell(20,7,'Observacion',1,0,'C',1);
						

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
	   $inhi_v='';
	   $baja='';
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
		   
		   $estado=$f_cb['estado'];
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
		     
   if(($inhi!='') or ($estado=='B') )
	   {	
	   if($inhi!=''){ $inhi_v='INHI';}
	   if($estado=='B'){ $baja='BAJA';}
	   }
	   
	    if ($estado_op=='R')
	     {
	      if($inhi!=''){ $inhi_v='INHI';}
	      if($estado=='B'){ $baja='BAJA';}
		  if(($inhi=='') and ($estado=='A'))
		    {
				$inhi_v='BLOQ';
			}
		 }
	   
	   
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
	$pdf->Cell(25,6,$imp_pag,1,0,'R',1);
	$pdf->Cell(25,6,$imp_form,1,0,'R',1);
	$pdf->Cell(25,6,$sal_disp,1,0,'R',1);
 if ($estado=='B')
	  {
	$pdf->Cell(20,6,$baja,1,0,'R',1);
	  }
else
  {
	  $pdf->Cell(20,6,$inhi_v,1,0,'R',1);
  }
	
	
  //  $pdf->Cell(35,6,$concepto,1,0,'L',1);
	
	
	
    //Go to next row
   
    $i = $i + 1;

     $importe=$importe+$imp_pag;
	$total=$total+$imp_form;
	$saldo=$saldo+$sal_disp;

    
        $_pagi_sql1 = "SELECT * FROM orden_pago 
				              where orden_pago='$orden_pago' 
							   and ejercicio ='$ejer'
							   and saf='$saf'";
				 if (!($_pagi_result1= mysql_query($_pagi_sql1, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}			

	  
	  $cantp = mysql_num_rows($_pagi_result1);

	  
	
  if($cantp > 0)
       {
		   if (($i == $max) or($i>18))
                {



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
			
			$pdf->SetFont('Arial','IB',7);
			$pdf->setY(25);
			$pdf->cell(0,0,'LISTADO DE CONSULTA',0,'B','C',0);
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
			$pdf->Cell(60,7,'Concepto',1,0,'C',1);
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
			$pdf->Cell(60,7,'Concepto',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
 $pdf->Cell(20,7,'Observacion',1,0,'C',1);
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
	$pdf->Cell(60,6,$concepto,1,0,'L',1);
	$pdf->SetFont('courier',$negra,8);
	$pdf->Cell(25,6,$total_p,1,0,'R',1);
	$pdf->Cell(20,6,'',1,0,'R',1);
	
	
	
  //  $pdf->Cell(35,6,$concepto,1,0,'L',1);
	
	
	
    //Go to next row
   
    $i = $i + 1;

   
     }
 }
 

 }// fin de pendientes

if (($i == $max) or($i>18))
 {



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
			
			$pdf->SetFont('Arial','IB',7);
			$pdf->setY(25);
			$pdf->cell(0,0,'LISTADO DE CONSULTA',0,'B','C',0);
			$pdf->setY(35);
			$pdf->cell(0,0,'ORDENES PENDIENTE DE PAGO',0,'B','C',0);


			
			
			$y_axis_initial = 45;
		    $pdf->SetFont('courier','B',7);
            $pdf->SetFillColor(256,256,256);
			$pdf->SetY($y_axis);
		    $pdf->SetX(15);   
			$pdf->Cell(120,5,'TOTAL PAGO PENDIENTE: ',0,0,'R',1);
			$pdf->Cell(75,5,number_format($importe,2),0,0,'R',1);
			$pdf->Cell(25,5,number_format($total,2),0,0,'R',1);
			$pdf->Cell(25,5,number_format($saldo,2),0,0,'R',1);
			$pdf->SetY($y_axis=$y_axis+5);
			$pdf->SetX(15);
			$pdf->Cell(265,4,'','T',0,'L',1);
			$i = 0;
			
			//Set maximum rows per page
			$max = 20;
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
		$pdf->Cell(75,5,number_format($importe,2),0,0,'R',1);
		$pdf->Cell(25,5,number_format($total,2),0,0,'R',1);
		$pdf->Cell(25,5,number_format($saldo,2),0,0,'R',1);
		$pdf->SetY($y_axis=$y_axis+5);
        $pdf->SetX(15);
        $pdf->Cell(265,4,'','T',0,'L',1);
		 $i = $i + 2;
			
  }

 }
 
	   
        $_pagi_sql1 = "SELECT ejercicio, o.saf, orden_pago, fecha, apellido, nombre, razon_social, concepto, total
FROM orden_pago AS o, beneficiarios_aprobados AS b
				              where (orden_pago='$nom' or cuit ='$nom') 
							      and cuitl=cuit
							      and ejercicio >'2008' ORDER BY fecha DESC ";
				 if (!($_pagi_resultp= mysql_query($_pagi_sql1, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}			
 
 
      $cant_p = mysql_num_rows($_pagi_resultp);
 
 
 

if (($i == $max) or($i>18) or ($cant==0))
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
			$pdf->setY(25);
			$pdf->cell(0,0,'LISTADO DE CONSULTA',0,'B','C',0);
			$pdf->setY(35);
			$pdf->cell(0,0,'PAGOS TOTAL',0,'B','C',0);


			
			
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
			$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
			$pdf->Cell(20,7,'Observacion',1,0,'C',1);
						
			$i = 0;
			
			//Set maximum rows per page
			$max = 20;
			$y_axis=45;
			//Set Row Height
			$row_height = 7;
			
			}
	else
	{
        $pdf->SetFont('Arial','IB',7);
			$pdf->setY($y_axis=$y_axis+7);
			$pdf->cell(0,0,'PAGOS TOTAL',0,'B','C',0);
   
	        $pdf->SetFillColor(256,256,256);
			$pdf->SetFont('Arial','B',6);
			$pdf->setY($y_axis=$y_axis+7);
			$pdf->SetX(15);
			$pdf->Cell(8,7,'Nº',1,0,'C',1);
			$pdf->Cell(12,7,'Ejercicio',1,0,'C',1);
			$pdf->Cell(10,7,'Saf',1,0,'C',1);
			$pdf->Cell(20,7,'Orden de Pago',1,0,'C',1);
			$pdf->Cell(20,7,'Fecha de Orden',1,0,'C',1);
			$pdf->Cell(60,7,'Beneficiarios',1,0,'C',1);
			$pdf->Cell(60,7,'Concepto',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
			$pdf->Cell(20,7,'Observacion',1,0,'C',1);		
			
	}
 if($cant_p > 0)
    {
   while ($f_ord=mysql_fetch_array($_pagi_resultp))
	  {
		  
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
			
			$pdf->SetFont('Arial','IB',7);
			$pdf->setY(25);
			$pdf->cell(0,0,'LISTADO DE CONSULTA',0,'B','C',0);
			$pdf->setY(35);
			$pdf->cell(0,0,'PAGO TOTAL',0,'B','C',0);
			
			
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
			$pdf->Cell(60,7,'Concepto',1,0,'C',1);
			$pdf->Cell(25,7,'Imp. Pagado',1,0,'C',1);
			$pdf->Cell(20,7,'Observacion',1,0,'C',1);
						
			$i = 0;
			
			//Set maximum rows per page
			$max = 20;
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
            $$orden_pago = $f_ord['orden_pago'];
            $fecha = $f_ord['fecha'];
			$concepto=substr($f_ord['concepto'],0,40);
            $total_p=$f_ord['total'];
			
			
		
			
			
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
	$pdf->Cell(60,6,$concepto,1,0,'L',1);
	$pdf->SetFont('courier',$negra,8);
	$pdf->Cell(25,6,$total_p,1,0,'R',1);
	$pdf->Cell(20,6,'',1,0,'R',1);
	
	
	
  //  $pdf->Cell(35,6,$concepto,1,0,'L',1);
	
	
	
    //Go to next row
    $i = $i + 1;

  $pago_total=$pago_total+$total_p;


	  }
	
if (($i == $max) or($i>18))
 {



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
			
			$pdf->SetFont('Arial','IB',7);
			$pdf->setY(25);
			$pdf->cell(0,0,'LISTADO DE CONSULTA',0,'B','C',0);
			$pdf->setY(35);
			$pdf->cell(0,0,'ORDENES PENDIENTE DE PAGO',0,'B','C',0);


			
			
			$y_axis_initial = 45;
		    $pdf->SetFont('courier','B',7);
            $pdf->SetFillColor(256,256,256);
			$pdf->SetY($y_axis);
		    $pdf->SetX(15);   
			$pdf->Cell(120,5,'TOTAL PAGADO: ',0,0,'R',1);
			$pdf->Cell(75,5,number_format($pago_total,2),0,0,'R',1);
			
			$pdf->SetY($y_axis=$y_axis+5);
			$pdf->SetX(15);
			$pdf->Cell(220,4,'','T',0,'L',1);
			$i = 0;
			
			//Set maximum rows per page
			$max = 20;
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
		$pdf->Cell(75,5,number_format($pago_total,2),0,0,'R',1);
		
		$pdf->SetY($y_axis=$y_axis+5);
        $pdf->SetX(15);
        $pdf->Cell(220,4,'','T',0,'L',1);
		 $i = $i + 2;
			
  }




	}
	
	
	
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
