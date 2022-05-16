<?php
error_reporting (E_ERROR);
    
	/*include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	*/

    include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    //include('conexion/extras.php');*/
 	
	///////////////////////////////////////////////////////
  // $fechaant=$_GET['fehcaa'];
//	$fechahoy=$_GET['fechah'];
	$mes = $_GET['mm'];
	$ejercicio = $_GET['aa'];   
	
	
	
	///////////////////
	
   $f=strftime("%Y-%m-%d");
   $dia = date("d/m/Y");
   $hora =date("h:i");
   
    
   
   ////////////////////////////
	
  $_pagi_sql = "SELECT *		FROM `limites_f`,NRO_SAF
									WHERE numero=entidad
									AND`mm` ='$mes'
									AND `aa` ='$ejercicio'
									";
							  
				
  
   
				 if (!($_pagi_result= mysqli_query($conexion_mysql,$_pagi_sql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}		
		 $cant = mysqli_num_rows($_pagi_result);
					  
		
  $nombre_mes=ltrim($mes, '0');
	
	
			
			
  $meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto',
                                        'Septiembre','Octubre','Noviembre','Diciembre');						  
			  
		

  $fecha_ac = "SELECT MAX( `fecha_p` ) as fecha_ac FROM `analisis_f`
              WHERE `mm` ='$mes'
              AND `aa` ='$ejercicio' ";
							  
				 
   
				 if (!($fecha_ac_res= mysqli_query($conexion_mysql,$fecha_ac)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}		
 $f_ultact = mysqli_fetch_array ($fecha_ac_res);
 
  

$fecha_ua = date("d-m-Y", strtotime($f_ultact['fecha_ac']));
  
define('FPDF_FONTPATH','font/');
require('../fpdf.php');

//Connect to your database
//Create new pdf file
$pdf=new FPDF();
//$pdf=new PDF_AutoPrint();
$pdf=new FPDF('L','mm','Legal');
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
$pdf->Image('../img/membrete11.jpg',10,2,190);
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

$pdf->SetFont('Arial','IB',9);
$pdf->setY(30);
$pdf->cell(0,0,'INFORME GENERAL POR FUENTE DE FINANCIAMIENTO '.strtoupper($meses{$nombre_mes-1}).', '.$ejercicio,0,'B','C',0);
$pdf->SetFont('Arial','IB',7);
$pdf->setY(35);
$pdf->SetX(140);
$pdf->cell(0,0,'ULTIMA ACTUALIZACION  '.$fecha_ua,0,'B','C',0);


$y_axis_initial = 40;

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',7);
$pdf->SetY($y_axis_initial);
$pdf->SetX(15);
$pdf->Cell(10,8,'SAF',1,0,'C',1);
$pdf->Cell(90,8,'DENOMINACION',1,0,'C',1);
$pdf->Cell(30,8,'LIMITE',1,0,'C',1);



$pdf->Cell(70,8,'FF DEL TESORO 11',1,0,'C',1);
$pdf->SetY($y_axis_initial+6);
$pdf->SetX(145);
$pdf->Cell(35,1,'FUNCIONAMIENTO',0,0,'C',0);
$pdf->SetX(180);
$pdf->Cell(35,1,'EXCEPCION',0,0,'C',0);

$pdf->SetY($y_axis_initial);
$pdf->SetX(215);
$pdf->Cell(15,8,'VARIACION',1,0,'C',1);




$pdf->SetX(230);
$pdf->Cell(70,8,'OTRAS FUENTES',1,0,'C',1);
$pdf->SetY($y_axis_initial+6);
$pdf->SetX(230);
$pdf->Cell(35,1,'FUNCIONAMIENTO',0,0,'C',0);
$pdf->SetX(265);
$pdf->Cell(35,1,'EXCEPCION',0,0,'C',0);


$pdf->SetY($y_axis_initial);
$pdf->SetX(300);
$pdf->Cell(15,8,'VARIACION',1,0,'C',1);

$pdf->SetX(315);
$pdf->Cell(40,8,'TOTAL GENERAL',1,0,'C',1);


$i = 0;

//Set maximum rows per page
$max = 20;
$y_axis=50;
//Set Row Height
$row_height = 7;
$cont=0;
$total_gral=0;
$r=7;
//$pdf->SetY($y_axis);
//$ir=$i;
while($f_limit = mysqli_fetch_array ($_pagi_result))
{

	             $tota_func_saf=0;
	             $tota_excp_saf=0;
	
	
	
	             $tota_func_saf_of=0;
	
	             $tota_excp_saf_of=0;
	             
	              $tota_ac_saf=0;
	
	
			//If the current row is the last one, create new page and print column title
			if ($i == $max)
			{
							//Add first page
				
				$pdf->SetY(-10);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');

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
			$pdf->Image('../img/membrete11.jpg',10,2,190);
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
			
$pdf->SetFont('Arial','IB',9);
$pdf->setY(30);
$pdf->cell(0,0,'INFORME GENERAL POR FUENTE DE FINANCIAMIENTO '.strtoupper($meses{$nombre_mes-1}).', '.$ejercicio,0,'B','C',0);
$pdf->SetFont('Arial','IB',7);
$pdf->setY(35);
$pdf->SetX(140);
$pdf->cell(0,0,'ULTIMA ACTUALIZACION  '.$fecha_ua,0,'B','C',0);


$y_axis_initial = 40;


$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',7);
$pdf->SetY($y_axis_initial);
$pdf->SetX(15);
$pdf->Cell(10,8,'SAF',1,0,'C',1);
$pdf->Cell(90,8,'DENOMINACION',1,0,'C',1);
$pdf->Cell(30,8,'LIMITE',1,0,'C',1);



$pdf->Cell(70,8,'FF DEL TESORO 11',1,0,'C',1);
$pdf->SetY($y_axis_initial+6);
$pdf->SetX(145);
$pdf->Cell(35,1,'FUNCIONAMIENTO',0,0,'C',0);
$pdf->SetX(180);
$pdf->Cell(35,1,'EXCEPCION',0,0,'C',0);

$pdf->SetY($y_axis_initial);
$pdf->SetX(215);
$pdf->Cell(15,8,'VARIACION',1,0,'C',1);




$pdf->SetX(230);
$pdf->Cell(70,8,'OTRAS FUENTES',1,0,'C',1);
$pdf->SetY($y_axis_initial+6);
$pdf->SetX(230);
$pdf->Cell(35,1,'FUNCIONAMIENTO',0,0,'C',0);
$pdf->SetX(265);
$pdf->Cell(35,1,'EXCEPCION',0,0,'C',0);


$pdf->SetY($y_axis_initial);
$pdf->SetX(300);
$pdf->Cell(15,8,'VARIACION',1,0,'C',1);

$pdf->SetX(315);
$pdf->Cell(40,8,'TOTAL GENERAL',1,0,'C',1);


//$pdf->Cell(100,7,'OBSERVACION',1,0,'C',1);
//				$pdf->Cell(100,7,'OBSERVACION',1,0,'C',1);
			$i = 0;
			
			//Set maximum rows per page
			//$max = 200;
			$y_axis=50;
			//Set Row Height
			//$row_height = 7;
			
//$ir=$i;

	 
        //Set $i variable to 0 (first row)
        
    }

                  $saf=$f_limit['entidad'];
	              $denominacion=$f_limit['nombre'];
				  $total_l=$f_limit['total'];
				  $total_g=$total_g+$total_l;
	
	
	
	$saf_ac = "SELECT sum(total) as acumulado
									FROM `analisis_f`
									WHERE `mm` ='$mes'
									AND `aa` ='$ejercicio'
									and entidad ='$saf'
									";
							  
				
  
   
				 if (!($f_saf_ac= mysqli_query($conexion_mysql,$saf_ac)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}	
				  
				  $f_safac=mysqli_fetch_array($f_saf_ac);
					  $tota_ac_saf=$f_safac['acumulado'];
	
	
	
 
	$saf_ff = "SELECT sum( total ) AS acumulado, extra
									FROM `analisis_f`
									WHERE `mm` ='$mes'
									AND `aa` ='$ejercicio'
									and entidad ='$saf'
									AND ff='11'
									group by extra
									";
							  
				
  
   
				 if (!($r_saf_ac= mysqli_query($conexion_mysql,$saf_ff)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}	
				  
				while($f_saf_ff=mysqli_fetch_array($r_saf_ac))
				{
					if ($f_saf_ff['extra']=='N')
					 {
						$tota_func_saf=$f_saf_ff['acumulado'];
					 }
					if ($f_saf_ff['extra']=='S')
					 {
						$tota_excp_saf=$f_saf_ff['acumulado'];
					 }
					
				}
					
	
	
	 $saf_of = "SELECT sum( total ) AS acumulado, extra
									FROM `analisis_f`
									WHERE `mm` ='$mes'
									AND `aa` ='$ejercicio'
									and entidad ='$saf'
									AND ff !='11'
									group by extra
									";
							  
				
  
   
				 if (!($r_saf_of= mysqli_query($conexion_mysql,$saf_of)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}	
				  
				while($f_saf_of=mysqli_fetch_array($r_saf_of))
				{
					if ($f_saf_of['extra']=='N')
					 {
						$tota_func_saf_of=$f_saf_of['acumulado'];
					 }
					if ($f_saf_of['extra']=='S')
					 {
						$tota_excp_saf_of=$f_saf_of['acumulado'];
					 }
					
				}
	
	
	
				  
				  
				  $total_func_ff =$total_func_ff+$tota_func_saf;
	              $total_excp_ff =$total_excp_ff+$tota_excp_saf;
	
	
	
	               $total_func_of =$total_func_of+$tota_func_saf_of;
	
	               $total_excp_of =$total_excp_of+$tota_excp_saf_of;
				 
	             
	   ////VARIACION
	
	
	            // $total_d_ff_f=$total_d+$dif;
				 // $dif11=$total_l-$tota_func_saf;  
		         
	              $var11=$tota_func_saf*100;
				  $por11=$var11/$total_l;
				  $english_format_number11 = number_format($por11, 2, '.', '');
	
	
	             $varof=$tota_func_saf_of*100;
				  $porof=$varof/$total_l;
				  $english_format_number_of = number_format($porof, 2, '.', '');
	
	            //   $total_e=$total_e+$tota_ae_saf;
	
	
	//$total_n=$total_n+$tota_ae_saf;
	
//	$total_n_of=$total_n_of+$tota_an_saf;

	$pdf->SetFont('courier','B',7);
	$pdf->SetY($y_axis);
	
	$pdf->SetX(15);
	$cont=$cont+1;
    $pdf->Cell(10,$r,$saf,1,0,'C',1); 
	$pdf->SetFont('arial','B',6);
	$pdf->Cell(90,$r,strtoupper($denominacion),1,0,'L',1);
	
	$pdf->SetFont('courier','B',8);
    $pdf->Cell(30,$r,number_format($total_l,2, ',', '.'),1,0,'R',1);
	
	$pdf->Cell(35,$r,number_format($tota_func_saf ,2, ',', '.'),1,0,'R',1);
	$pdf->Cell(35,$r,number_format($tota_excp_saf,2, ',', '.'),1,0,'R',1);
	
	if($english_format_number11>100)
	{
		$pdf->SetFillColor(253, 93, 96);
		$pdf->Cell(15,$r,$english_format_number11.' %',1,0,'R',true);
	}
	else
	{
$pdf->SetFillColor(256,256,256);
		$pdf->Cell(15,$r,$english_format_number11.' %',1,0,'R',1);
	}
$pdf->SetFillColor(256,256,256);
	
	$pdf->Cell(35,$r,number_format($tota_func_saf_of,2, ',', '.'),1,0,'R',1);
	$pdf->Cell(35,$r,number_format($tota_excp_saf_of,2, ',', '.'),1,0,'R',1);
	
	
	
	
	
	
	
	
	if($english_format_number_of >100)
	{
		$pdf->SetFillColor(253, 93, 96);
		$pdf->Cell(15,$r,$english_format_number_of.' %',1,0,'R',true);
	}
	else
	{
$pdf->SetFillColor(256,256,256);
		$pdf->Cell(15,$r,$english_format_number_of.' %',1,0,'R',1);
	}
	
	
	$pdf->SetFillColor(256,256,256);
	$pdf->Cell(40,$r,number_format($tota_ac_saf,2, ',', '.'),1,0,'R',1);
	
	$total_gral_ac=$total_gral_ac+$tota_ac_saf;
	
	$pdf->SetFillColor(256,256,256);
	$pdf->SetFont('arial','B',6);
	
	
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
	
	
	
}
$total_v=$total_e*100/$total_g;
$total_v_of=$total_n_of*100/$total_g;


                  $tvar11=$total_func_ff*100;
				  $tpor11=$tvar11/$total_g;
				  $tenglish_format_number11 = number_format($tpor11, 2, '.', '');
	
	
	             $tvarof=$total_func_of*100;
				  $tporof=$tvarof/$total_g;
				  $tenglish_format_number_of = number_format($tporof, 2, '.', '');



	$pdf->SetY(-10);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
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
			$pdf->Image('../img/membrete11.jpg',10,2,190);
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
$pdf->SetFont('Arial','IB',9);
$pdf->setY(30);
$pdf->cell(0,0,'INFORME GENERAL POR FUENTE DE FINANCIAMIENTO '.strtoupper($meses{$nombre_mes-1}).', '.$ejercicio,0,'B','C',0);
$pdf->SetFont('Arial','IB',7);
$pdf->setY(35);
$pdf->SetX(140);
$pdf->cell(0,0,'ULTIMA ACTUALIZACION  '.$fecha_ua,0,'B','C',0);


$y_axis_initial = 40;
$i=$y_axis_initial;

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($y_axis_initial);
$pdf->SetX(30);
$pdf->Cell(80,8,'TOTAL LIMITE',0,0,'L',1);
$pdf->SetY($i=$i+10);
$pdf->Cell(80,8,'FF DEL TESORO (11)',0,0,'L',1);
$pdf->SetY($i=$i+10);
$pdf->Cell(0,4,'','T',0,'L',1);
$pdf->SetY($i=$i+10);
$pdf->Cell(80,1,'FUNCIONAMIENTO',0,0,'L',0);
$pdf->SetY($i=$i+10);
$pdf->Cell(80,1,'EXCEPCION',0,0,'L',0);
$pdf->SetY($i=$i+10);
$pdf->Cell(80,1,'TOTAL',0,0,'L',0);
$pdf->SetY($i=$i+10);

$pdf->Cell(80,8,'VARIACION',0,0,'L',1);
$pdf->SetX(40);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(80,8,'Limite / Funcionamiento',0,0,'L',1);
$pdf->SetFont('Arial','B',10);
$pdf->SetX(30);

$pdf->SetY($i=$i+10);
$pdf->Cell(0,4,'','T',0,'L',1);
$pdf->SetY($i=$i+10);
$pdf->Cell(80,8,'OTRAS FUENTES',0,0,'L',1);
$pdf->SetY($i=$i+10);
$pdf->Cell(0,4,'','T',0,'L',1);

$pdf->SetY($i=$i+10);
$pdf->Cell(80,1,'FUNCIONAMIENTO',0,0,'L',0);
$pdf->SetY($i=$i+10);
$pdf->Cell(80,1,'EXCEPCION',0,0,'L',0);
$pdf->SetY($i=$i+10);
$pdf->Cell(80,1,'TOTAL',0,0,'L',0);
$pdf->SetY($i=$i+10);
$pdf->Cell(80,8,'VARIACION',0,0,'L',1);
$pdf->SetX(40);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(80,8,'Limite / Funcionamiento',0,0,'L',1);
$pdf->SetFont('Arial','B',10);
$pdf->SetX(30);
$pdf->SetY($i=$i+10);
$pdf->Cell(0,4,'','T',0,'L',1);
$pdf->SetY($i=$i+10);
$pdf->SetX(30);
$pdf->Cell(80,8,'TOTAL GENERAL',0,0,'L',1);

$i = 0;
			
			//Set maximum rows per page
			//$max = 200;
			$y_axis=50;
			//Set Row Height
			$row_height = 7;
			
 $y_axis_initial = 40;
$i=$y_axis_initial;
$T11=$total_func_ff+$total_excp_ff;
$TOF=$total_func_of+$total_excp_of;

$pdf->SetY($y_axis_initial);
$pdf->SetX(100);
$pdf->Cell(40,3,number_format($total_g,2, ',', '.'),0,0,'R',1);
$pdf->SetY($i=$i+30);

$pdf->SetX(150);
$pdf->Cell(40,3,number_format($total_func_ff,2, ',', '.'),0,0,'R',1);
$pdf->SetY($i=$i+10);
$pdf->SetX(150);
$pdf->Cell(40,3,number_format($total_excp_ff,2, ',', '.'),0,0,'R',1);
$pdf->SetY($i=$i+10);
$pdf->SetX(100);
$pdf->Cell(40,3,number_format($T11,2, ',', '.'),0,0,'R',1);

$pdf->SetY($i=$i+10);
$pdf->SetX(150);

$pdf->Cell(25,3,number_format($tenglish_format_number11,2, ',', '.').' %',0,0,'R',1);



$pdf->SetY($i=$i+40);

$pdf->SetX(150);
$pdf->Cell(40,3,number_format($total_func_of,2, ',', '.'),0,0,'R',1);
$pdf->SetY($i=$i+10);
$pdf->SetX(150);
$pdf->Cell(40,8,number_format($total_excp_of,2, ',', '.'),0,0,'R',1);
$pdf->SetY($i=$i+10);
$pdf->SetX(100);
$pdf->Cell(40,3,number_format($TOF,2, ',', '.'),0,0,'R',1);

$pdf->SetY($i=$i+10);
$pdf->SetX(150);

$pdf->Cell(25,8,number_format($tenglish_format_number_of,2, ',', '.').' %',0,0,'R',1);


$pdf->SetY($i=$i+20);

$pdf->SetX(100);
$pdf->Cell(40,8,number_format($total_gral_ac,2, ',', '.'),0,0,'R',1);

	
		
	/*

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($y_axis+7); 
$pdf->SetX(15);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','IB',7);
 $pdf->SetX(15);

$pdf->Cell(100,7,'TOTAL GENERAL',1,0,'C',1);
$pdf->Cell(30,7,'LIMITE',1,0,'C',1);

$pdf->Cell(35,7,'FUNCIONAMIENTO',1,0,'C',1);
$pdf->Cell(35,7,'EXCEPCION',1,0,'C',1);

//$pdf->Cell(25,7,'VARIACION',1,0,'C',1);
$pdf->Cell(15,7,'VARIACION',1,0,'C',1);

$pdf->Cell(35,7,'FUNCIONAMIENTO',1,0,'C',1);
$pdf->Cell(35,7,'EXCEPCION',1,0,'C',1);
$pdf->Cell(15,7,'VARIACION',1,0,'C',1);	
	
	$pdf->Cell(40,7,'TOTAL GENERAL',1,0,'C',1);	

//$pdf->Cell(100,7,'OBSERVACION',1,0,'C',1);
$pdf->SetFillColor(256,256,256);
 $pdf->SetFont('courier','IB',9);
$pdf->SetY($y_axis+18); 
$pdf->SetX(30);

$pdf->SetX(110);
$pdf->Cell(30,3,number_format($total_g,2, ',', '.'),0,0,'R',1);
$pdf->SetX(130);
$pdf->Cell(35,3,number_format($total_func_ff,2, ',', '.'),0,0,'R',1);
	$pdf->SetX(170);
$pdf->Cell(35,3,number_format($total_excp_ff,2, ',', '.'),0,0,'R',1);
	$pdf->SetX(210);
$pdf->Cell(15,3,number_format($total_v,2, ',', '.'),0,0,'R',1);
	$pdf->SetX(225);
	
	
$pdf->Cell(35,3,number_format($total_func_of,2, ',', '.').' %',0,0,'R',1);
	$pdf->SetX(260);
	
	
$pdf->Cell(35,3,number_format($total_excp_of,2, ',', '.').' %',0,0,'R',1);
	
$pdf->SetX(17);
$pdf->SetY($i=$i+3); 
//$pdf->Cell(270,5,'','T',0,'L',1);

	
}*/
///////////////////
$pdf->SetY(-10);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');

$pdf->AliasNbPages();

//////// fin Formacion ACademica
$pdf->Output();
 
?>
