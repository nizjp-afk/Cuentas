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
$pdf->cell(0,0,'ANALISIS ACUMULADO POR FUENTE DE FINANCIAMIENTO '.strtoupper($meses{$nombre_mes-1}).', '.$ejercicio,0,'B','C',0);
$pdf->SetFont('Arial','IB',7);
$pdf->setY(35);
$pdf->SetX(140);
$pdf->cell(0,0,'ULTIMA ACTUALIZACION  '.$fecha_ua,0,'B','C',0);


$y_axis_initial = 40;

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',7);
$pdf->SetY($y_axis_initial);
$pdf->SetX(10);
$pdf->Cell(10,7,'SAF',1,0,'C',1);
//$pdf->Cell(80,7,'DENOMINACION',1,0,'C',1);
$pdf->Cell(35,7,'LIMITE',1,0,'C',1);

$pdf->Cell(35,7,'ACUMULADO',1,0,'C',1);
//$pdf->Cell(30,7,'EXCEPCIONES',1,0,'C',1);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(30,7,'F.F TESORO PCIAL ',1,0,'C',1);
$pdf->SetY($y_axis_initial+5);
$pdf->SetX(92);
$pdf->Cell(30,1,'(FF 11)',0,0,'C',0);
$pdf->SetY($y_axis_initial);
$pdf->SetX(120);
$pdf->Cell(15,7,'V %',1,0,'C',1);
$pdf->SetY($y_axis_initial);
$pdf->SetX(135);
$pdf->Cell(30,7,'F.F RECURSOS PROPIOS',1,0,'C',1);
$pdf->SetY($y_axis_initial+5);
$pdf->SetX(135);
$pdf->Cell(30,1,'(FF 12)',0,0,'C',0);
$pdf->SetY($y_axis_initial);
$pdf->SetX(165);
$pdf->Cell(15,7,'V %',1,0,'C',1);
$pdf->SetY($y_axis_initial);
$pdf->SetX(180);
$pdf->Cell(30,7,'F.F CON AFECTACION',1,0,'C',1);
$pdf->SetY($y_axis_initial+5);
$pdf->SetX(182);
$pdf->Cell(30,1,'ESPECIFICA (FF 13)',0,0,'C',0);
$pdf->SetY($y_axis_initial);
$pdf->SetX(210);
$pdf->Cell(15,7,'V %',1,0,'C',1);
$pdf->SetY($y_axis_initial);
$pdf->SetX(225);
//$pdf->SetY($y_axis_initial);
$pdf->Cell(30,7,'F.F TRANSFERENCIAS',1,0,'C',1);
$pdf->SetY($y_axis_initial+5);
$pdf->SetX(227);
$pdf->Cell(30,1,'INTERNA (FF 14)',0,0,'C',0);
$pdf->SetY($y_axis_initial);
$pdf->SetX(255);
$pdf->Cell(15,7,'V %',1,0,'C',1);

$pdf->SetY($y_axis_initial);
$pdf->SetX(270);
//$pdf->SetY($y_axis_initial);
$pdf->Cell(27,7,'F.F CREDITO INTERNO',1,0,'C',1);
$pdf->SetY($y_axis_initial+5);
$pdf->SetX(270);
$pdf->Cell(30,1,'(FF 15)',0,0,'C',0);
$pdf->SetY($y_axis_initial);
$pdf->SetX(297);
$pdf->Cell(15,7,'V %',1,0,'C',1);
$pdf->SetY($y_axis_initial);
$pdf->SetX(312);
//$pdf->SetY($y_axis_initial);
$pdf->Cell(27,7,'F.F CREDITO EXTERNO',1,0,'C',1);
$pdf->SetY($y_axis_initial+5);
$pdf->SetX(315);
$pdf->Cell(27,1,'(FF 22)',0,0,'C',0);
$pdf->SetY($y_axis_initial);
$pdf->SetX(339);
$pdf->Cell(15,7,'V %',1,0,'C',1);



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

	$total_11=0;
	$total_12=0;
	$total_13=0;
	$total_14=0;
	$total_15=0;
	$total_22=0;
	$por11=0;
	$por12=0;
	$por13=0;
	$por14=0;
	$por15=0;
	$por22=0;
	$english_format_number11=0;
	$english_format_number12=0;
	$english_format_number13=0;
	$english_format_number14=0;
	$english_format_number15=0;
	$english_format_number22=0;
	
	
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
$pdf->cell(0,0,'ANALISIS ACUMULADO POR FUENTE DE FINANCIAMIENTO '.strtoupper($meses{$nombre_mes-1}).', '.$ejercicio,0,'B','C',0);
$pdf->SetFont('Arial','IB',7);
$pdf->setY(35);
$pdf->SetX(140);
$pdf->cell(0,0,'ULTIMA ACTUALIZACION  '.$fecha_ua,0,'B','C',0);



$y_axis_initial = 40;

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($y_axis_initial);
$pdf->SetX(15);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',7);
$pdf->SetY($y_axis_initial);
//$pdf->SetX(15);
$pdf->SetX(10);
$pdf->Cell(10,7,'SAF',1,0,'C',1);
//$pdf->Cell(80,7,'DENOMINACION',1,0,'C',1);
$pdf->Cell(35,7,'LIMITE',1,0,'C',1);

$pdf->Cell(35,7,'ACUMULADO',1,0,'C',1);
//$pdf->Cell(30,7,'EXCEPCIONES',1,0,'C',1);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(30,7,'F.F TESORO PCIAL ',1,0,'C',1);
$pdf->SetY($y_axis_initial+5);
$pdf->SetX(92);
$pdf->Cell(30,1,'(FF 11)',0,0,'C',0);
$pdf->SetY($y_axis_initial);
$pdf->SetX(120);
$pdf->Cell(15,7,'V %',1,0,'C',1);
$pdf->SetY($y_axis_initial);
$pdf->SetX(135);
$pdf->Cell(30,7,'F.F RECURSOS PROPIOS',1,0,'C',1);
$pdf->SetY($y_axis_initial+5);
$pdf->SetX(135);
$pdf->Cell(30,1,'(FF 12)',0,0,'C',0);
$pdf->SetY($y_axis_initial);
$pdf->SetX(165);
$pdf->Cell(15,7,'V %',1,0,'C',1);
$pdf->SetY($y_axis_initial);
$pdf->SetX(180);
$pdf->Cell(30,7,'F.F CON AFECTACION',1,0,'C',1);
$pdf->SetY($y_axis_initial+5);
$pdf->SetX(182);
$pdf->Cell(30,1,'ESPECIFICA (FF 13)',0,0,'C',0);
$pdf->SetY($y_axis_initial);
$pdf->SetX(210);
$pdf->Cell(15,7,'V %',1,0,'C',1);
$pdf->SetY($y_axis_initial);
$pdf->SetX(225);
//$pdf->SetY($y_axis_initial);
$pdf->Cell(30,7,'F.F TRANSFERENCIAS',1,0,'C',1);
$pdf->SetY($y_axis_initial+5);
$pdf->SetX(227);
$pdf->Cell(30,1,'INTERNA (FF 14)',0,0,'C',0);
$pdf->SetY($y_axis_initial);
$pdf->SetX(255);
$pdf->Cell(15,7,'V %',1,0,'C',1);

$pdf->SetY($y_axis_initial);
$pdf->SetX(270);
//$pdf->SetY($y_axis_initial);
$pdf->Cell(27,7,'F.F CREDITO INTERNO',1,0,'C',1);
$pdf->SetY($y_axis_initial+5);
$pdf->SetX(270);
$pdf->Cell(30,1,'(FF 15)',0,0,'C',0);
$pdf->SetY($y_axis_initial);
$pdf->SetX(297);
$pdf->Cell(15,7,'V %',1,0,'C',1);
$pdf->SetY($y_axis_initial);
$pdf->SetX(312);
//$pdf->SetY($y_axis_initial);
$pdf->Cell(27,7,'F.F CREDITO EXTERNO',1,0,'C',1);
$pdf->SetY($y_axis_initial+5);
$pdf->SetX(315);
$pdf->Cell(27,1,'(FF 22)',0,0,'C',0);
$pdf->SetY($y_axis_initial);
$pdf->SetX(339);
$pdf->Cell(15,7,'V %',1,0,'C',1);



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
	
	
	 $saf_e = "SELECT sum(total) as acumulado,ff
									FROM `analisis_f`
									WHERE `mm` ='$mes'
									AND `aa` ='$ejercicio'
									and entidad ='$saf'
									group by ff
									
									";
							  
				
    
				 if (!($r_saf_a11= mysqli_query($conexion_mysql,$saf_e)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}	
				  
				  while ($f_saf_a11=mysqli_fetch_array($r_saf_a11))
				  {
					  
					  $ff=$f_saf_a11['ff'];
					  
					  if ($ff=='11')
					  {
						    $total_11=$f_saf_a11['acumulado'];
						  
						     $var11=$total_11*100;
				             $por11=$var11/$total_l;
				             $english_format_number11 = number_format($por11, 2, '.', '');
						  
						  
						  
					  }

					  if ($ff=='12')
					  {
						    $total_12=$f_saf_a11['acumulado'];
						  
						  
						  
						     $var12=$total_12*100;
				             $por12=$var12/$total_l;
				             $english_format_number12 = number_format($por12, 2, '.', '');
						  
						  
					  }
					  if ($ff=='13')
					  {
						    $total_13=$f_saf_a11['acumulado'];
						  
						  
						     $var13=$total_13*100;
				             $por13=$var13/$total_l;
				             $english_format_number13 = number_format($por13, 2, '.', '');
						  
						  
					  }

				  if ($ff=='14')
					  {
						    $total_14=$f_saf_a11['acumulado'];
					  
						     $var14=$total_14*100;
				             $por14=$var14/$total_l;
				             $english_format_number14 = number_format($por14, 2, '.', '');
						  
					    
					  }
					  if ($ff=='15')
					  {
						    $total_15=$f_saf_a11['acumulado'];
						  
						  
						     $var15=$total_15*100;
				             $por15=$var15/$total_l;
				             $english_format_number15 = number_format($por15, 2, '.', '');
						  
						  
					  }

					  if ($ff=='22')
					  {
						    $total_22=$f_saf_a11['acumulado'];
						  
						  
						     $var22=$total_22*100;
				             $por22=$var22/$total_l;
				             $english_format_number22 = number_format($por22, 2, '.', '');
						  
						  
					  }
					  
				  }
	
	$total_g_11=$total_g_11+$total_11;
	$total_g_12=$total_g_12+$total_12;
	$total_g_13=$total_g_13+$total_13;
	$total_g_14=$total_g_14+$total_14;
	$total_g_15=$total_g_15+$total_15;
	$total_g_22=$total_g_22+$total_22;
	
	
	
				
				  
				  $total_a=$total_a+$tota_ac_saf;
				
				/*  
		          $var=$tota_ae_saf*100;
				  $por=$var/$total_l;
				  $english_format_number = number_format($por, 2, '.', '');
	
	
	             $varof=$tota_an_saf*100;
				  $porof=$varof/$total_l;
				  $english_format_number_of = number_format($porof, 2, '.', '');
	
	               $total_e=$total_e+$tota_ae_saf;
	
	
	//$total_n=$total_n+$tota_ae_saf;
	
	$total_n_of=$total_n_of+$tota_an_saf;*/
	
	

	$pdf->SetFont('courier','B',7);
	$pdf->SetY($y_axis);
	
	$pdf->SetX(10);
	$cont=$cont+1;
    $pdf->Cell(10,$r,$saf,1,0,'C',1); 
	$pdf->SetFont('arial','B',6);
	//$pdf->Cell(80,$r,strtoupper($denominacion),1,0,'L',1);
	
	$pdf->SetFont('courier','B',8);
    $pdf->Cell(35,$r,number_format($total_l,2, ',', '.'),1,0,'R',1);
	//$pdf->Cell(40,$r,$total_l,1,0,'C',1); 
	$pdf->Cell(35,$r,number_format($tota_ac_saf,2, ',', '.'),1,0,'R',1);
	
	$pdf->Cell(30,$r,number_format($total_11,2, ',', '.'),1,0,'R',1);
	
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
	
	
	$pdf->Cell(30,$r,number_format($total_12,2, ',', '.'),1,0,'R',1);
	
	if($english_format_number12>100)
	{
		$pdf->SetFillColor(253, 93, 96);
		$pdf->Cell(15,$r,$english_format_number12.' %',1,0,'R',true);
	}
	else
	{
$pdf->SetFillColor(256,256,256);
		$pdf->Cell(15,$r,$english_format_number12.' %',1,0,'R',1);
	}
$pdf->SetFillColor(256,256,256);
	
	$pdf->Cell(30,$r,number_format($total_13,2, ',', '.'),1,0,'R',1);
	
	if($english_format_number13>100)
	{
		$pdf->SetFillColor(253, 93, 96);
		$pdf->Cell(15,$r,$english_format_number13.' %',1,0,'R',true);
	}
	else
	{
$pdf->SetFillColor(256,256,256);
		$pdf->Cell(15,$r,$english_format_number13.' %',1,0,'R',1);
	}
$pdf->SetFillColor(256,256,256);
	
	$pdf->Cell(30,$r,number_format($total_14,2, ',', '.'),1,0,'R',1);
	
	if($english_format_number14>100)
	{
		$pdf->SetFillColor(253, 93, 96);
		$pdf->Cell(15,$r,$english_format_number14.' %',1,0,'R',true);
	}
	else
	{
$pdf->SetFillColor(256,256,256);
		$pdf->Cell(15,$r,$english_format_number14.' %',1,0,'R',1);
	}
$pdf->SetFillColor(256,256,256);
	
	$pdf->Cell(27,$r,number_format($total_15,2, ',', '.'),1,0,'R',1);
	
	if($english_format_number15>100)
	{
		$pdf->SetFillColor(253, 93, 96);
		$pdf->Cell(15,$r,$english_format_number15.' %',1,0,'R',true);
	}
	else
	{
$pdf->SetFillColor(256,256,256);
		$pdf->Cell(15,$r,$english_format_number15.' %',1,0,'R',1);
	}
$pdf->SetFillColor(256,256,256);
	
	$pdf->Cell(27,$r,number_format($total_22,2, ',', '.'),1,0,'R',1);
	
	if($english_format_number22>100)
	{
		$pdf->SetFillColor(253, 93, 96);
		$pdf->Cell(15,$r,$english_format_number22.' %',1,0,'R',true);
	}
	else
	{
$pdf->SetFillColor(256,256,256);
		$pdf->Cell(15,$r,$english_format_number22.' %',1,0,'R',1);
	}
$pdf->SetFillColor(256,256,256);
	
	
	
	
	
	$pdf->SetFillColor(256,256,256);
	$pdf->SetFont('arial','B',6);
	//$pdf->MultiCell(65,$r,$a_obser, 1, 'J', 1, 2, '' ,'', true);
	
//	$strText = str_replace("\n","<br>",$a_obser);
//$pdf->MultiCell(100,6,$strText, 1, 'J', 1, 2, '', '', true, null, true);
	
	//	$pdf->MultiCell(100,6,$a_obser."\n", 1, 'J', 1, 2, '' ,'', true);
	//$pdf->Cell(65,6,strtoupper($a_obser),1,0,'L',1);
	
	//Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
	
	//$total_a=$total_a+$tota_ac_saf;
		//		  $total_d=$total_d+$dif;
	//$total_g=$total_g+$total_l;
	
}
$total_v=$total_e*100/$total_g;
$total_v_of=$total_n_of*100/$total_g;


if ($i > 18)
{
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
$pdf->cell(0,0,'ANALISIS ACUMULADO POR FUENTE DE FINANCIAMIENTO '.strtoupper($meses{$nombre_mes-1}).', '.$ejercicio,0,'B','C',0);
$pdf->SetFont('Arial','IB',7);
$pdf->setY(35);
$pdf->SetX(140);
$pdf->cell(0,0,'ULTIMA ACTUALIZACION  '.$fecha_ua,0,'B','C',0);


$y_axis_initial = 40;		

	

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($y_axis_initial);
$pdf->SetX(15);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',7);
$pdf->SetY($y_axis_initial);
$pdf->SetX(15);

$pdf->Cell(100,7,'TOTAL GENERAL',1,0,'C',1);
$pdf->Cell(40,7,'LIMITE',1,0,'C',1);

$pdf->Cell(40,7,'ACUMULADO',1,0,'C',1);
$pdf->Cell(40,7,'FUENTE DEL TESORO 11',1,0,'C',1);
$pdf->Cell(40,7,'OTRAS FUENTES',1,0,'C',1);

$pdf->Cell(20,7,'VARIACION',1,0,'C',1);
$pdf->SetY($y_axis_initial+5);
$pdf->SetX(270);
$pdf->Cell(30,1,'(FF 11)',0,0,'C',0);
$pdf->SetY($y_axis_initial);
$pdf->SetX(295);
$pdf->Cell(20,7,'VARIACION',1,0,'C',1);
$pdf->SetY($y_axis_initial+5);
$pdf->SetX(290);
$pdf->Cell(30,1,'(OTRAS FF)',0,0,'C',0);;
//$pdf->Cell(100,7,'OBSERVACION',1,0,'C',1);
$pdf->SetFillColor(256,256,256);
 $pdf->SetFont('courier','IB',9);
$i = 0;
			
			//Set maximum rows per page
			//$max = 200;
			$y_axis=50;
			//Set Row Height
			$row_height = 7;
			
 $pdf->SetY($y_axis);

$pdf->SetX(30);

$pdf->SetX(115);
$pdf->Cell(40,3,number_format($total_g,2, ',', '.'),0,0,'R',1);
$pdf->SetX(150);
$pdf->Cell(40,3,number_format($total_a,2, ',', '.'),0,0,'R',1);
	$pdf->SetX(185);
$pdf->Cell(40,3,number_format($total_e,2, ',', '.'),0,0,'R',1);
	$pdf->SetX(220);
$pdf->Cell(40,3,number_format($total_n,2, ',', '.'),0,0,'R',1);
	
	

$pdf->Cell(25,3,number_format($total_v,2, ',', '.').' %',0,0,'R',1);
$pdf->SetX(17);
$pdf->SetY($i=$i+$r); 
$pdf->Cell(270,5,'','T',0,'L',1);

}
else
{
	$total_v_11=$total_g_11*100/$total_g;
	$total_v_12=$total_g_12*100/$total_g;
	$total_v_13=$total_g_13*100/$total_g;
	$total_v_14=$total_g_14*100/$total_g;
	$total_v_15=$total_g_15*100/$total_g;
	$total_v_22=$total_g_22*100/$total_g;
	
		
	

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($y_axis+7); 
$pdf->SetX(15);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','IB',7);
$pdf->SetY($y_axis+7); 
	$pdf->SetX(20);
$pdf->Cell(35,7,'LIMITE',1,0,'C',1);

$pdf->Cell(35,7,'ACUMULADO',1,0,'C',1);
//$pdf->Cell(30,7,'EXCEPCIONES',1,0,'C',1);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(30,7,'F.F TESORO PCIAL ',1,0,'C',1);
$pdf->SetY($y_axis+12);
$pdf->SetX(92);
$pdf->Cell(30,1,'(FF 11)',0,0,'C',0);
$pdf->SetY($y_axis+7);
$pdf->SetX(120);
$pdf->Cell(15,7,'V %',1,0,'C',1);
$pdf->SetY($y_axis+7);
$pdf->SetX(135);
$pdf->Cell(30,7,'F.F RECURSOS PROPIOS',1,0,'C',1);
$pdf->SetY($y_axis+12);
$pdf->SetX(135);
$pdf->Cell(30,1,'(FF 12)',0,0,'C',0);
$pdf->SetY($y_axis+7);
$pdf->SetX(165);
$pdf->Cell(15,7,'V %',1,0,'C',1);
$pdf->SetY($y_axis+7);
$pdf->SetX(180);
$pdf->Cell(30,7,'F.F CON AFECTACION',1,0,'C',1);
$pdf->SetY($y_axis+12);
$pdf->SetX(182);
$pdf->Cell(30,1,'ESPECIFICA (FF 13)',0,0,'C',0);
$pdf->SetY($y_axis+7);
$pdf->SetX(210);
$pdf->Cell(15,7,'V %',1,0,'C',1);
$pdf->SetY($y_axis+7);
$pdf->SetX(225);
//$pdf->SetY($y_axis_initial);
$pdf->Cell(30,7,'F.F TRANSFERENCIAS',1,0,'C',1);
$pdf->SetY($y_axis+12);
$pdf->SetX(227);
$pdf->Cell(30,1,'INTERNA (FF 14)',0,0,'C',0);
$pdf->SetY($y_axis+7);
$pdf->SetX(255);
$pdf->Cell(15,7,'V %',1,0,'C',1);

$pdf->SetY($y_axis+7);
$pdf->SetX(270);
//$pdf->SetY($y_axis_initial);
$pdf->Cell(27,7,'F.F CREDITO INTERNO',1,0,'C',1);
$pdf->SetY($y_axis+12);
$pdf->SetX(270);
$pdf->Cell(30,1,'(FF 15)',0,0,'C',0);
$pdf->SetY($y_axis+7);
$pdf->SetX(297);
$pdf->Cell(15,7,'V %',1,0,'C',1);
$pdf->SetY($y_axis+7);
$pdf->SetX(312);
//$pdf->SetY($y_axis_initial);
$pdf->Cell(27,7,'F.F CREDITO EXTERNO',1,0,'C',1);
$pdf->SetY($y_axis+12);
$pdf->SetX(315);
$pdf->Cell(27,1,'(FF 22)',0,0,'C',0);
$pdf->SetY($y_axis+7);
$pdf->SetX(339);
$pdf->Cell(15,7,'V %',1,0,'C',1);

	
	
//$pdf->Cell(100,7,'OBSERVACION',1,0,'C',1);
$pdf->SetFillColor(256,256,256);
 $pdf->SetFont('courier','IB',8);
 $pdf->SetX(9);
$pdf->SetY($y_axis+15); 
$pdf->Cell(10,7,'TOTAL ',0,0,'C',0);
$pdf->SetY($y_axis+22);
$pdf->SetX(9);
$pdf->Cell(10,1,'GENERAL',0,0,'C',0);	
	
	
	$pdf->SetY($y_axis+20); 


$pdf->SetX(20);
$pdf->Cell(35,3,number_format($total_g,2, ',', '.'),0,0,'R',1,false);
$pdf->SetX(55);
$pdf->Cell(35,3,number_format($total_a,2, ',', '.'),0,0,'R',1,false);
$pdf->SetX(90);
$pdf->Cell(30,3,number_format($total_g_11,2, ',', '.'),0,0,'R',false);
$pdf->SetX(124);
$pdf->Cell(10,3,number_format($total_v_11,2, ',', '.').'%',0,0,'R',false);
$pdf->SetX(133);
	$pdf->Cell(30,3,number_format($total_g_12,2, ',', '.'),0,0,'R',false);
$pdf->SetX(170);
$pdf->Cell(10,3,number_format($total_v_12,2, ',', '.').'%',0,0,'R',false);
$pdf->SetX(180);
$pdf->Cell(30,3,number_format($total_g_13,2, ',', '.'),0,0,'R',false);
$pdf->SetX(215);
$pdf->Cell(10,3,number_format($total_v_13,2, ',', '.').'%',0,0,'R',false);
$pdf->SetX(225);
$pdf->Cell(30,3,number_format($total_g_14,2, ',', '.'),0,0,'R',false);
$pdf->SetX(260);
$pdf->Cell(10,3,number_format($total_v_14,2, ',', '.').'%',0,0,'R',false);
$pdf->SetX(268);
$pdf->Cell(30,3,number_format($total_g_15,2, ',', '.'),0,0,'R',false);
$pdf->SetX(300);
$pdf->Cell(10,3,number_format($total_v_15,2, ',', '.').'%',0,0,'R',false);
$pdf->SetX(312);
$pdf->Cell(30,3,number_format($total_g_22,2, ',', '.'),0,0,'R',false);
$pdf->SetX(345);
$pdf->Cell(10,3,number_format($total_v_22,2, ',', '.').'%',0,0,'R',false);
	
$pdf->SetX(17);
$pdf->SetY($i=$i+3); 
//$pdf->Cell(270,5,'','T',0,'L',1);

	
}
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
