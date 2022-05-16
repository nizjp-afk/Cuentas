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
$pdf->SetX(15);
$pdf->Cell(10,7,'SAF',1,0,'C',1);
$pdf->Cell(90,7,'DENOMINACION',1,0,'C',1);
$pdf->Cell(40,7,'LIMITE',1,0,'C',1);

$pdf->Cell(40,7,'ACUMULADO',1,0,'C',1);
//$pdf->Cell(30,7,'EXCEPCIONES',1,0,'C',1);


$pdf->Cell(40,7,'FF DEL TESORO 11',1,0,'C',1);
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
$pdf->SetX(15);
$pdf->Cell(10,7,'SAF',1,0,'C',1);
$pdf->Cell(90,7,'DENOMINACION',1,0,'C',1);
$pdf->Cell(40,7,'LIMITE',1,0,'C',1);

$pdf->Cell(40,7,'ACUMULADO',1,0,'C',1);
//$pdf->Cell(30,7,'EXCEPCIONES',1,0,'C',1);


$pdf->Cell(40,7,'FF DEL TESORO 11',1,0,'C',1);
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
	
	
	 $saf_e = "SELECT sum(total) as acumulado
									FROM `analisis_f`
									WHERE `mm` ='$mes'
									AND `aa` ='$ejercicio'
									and entidad ='$saf'
									AND ff='11'
									
									";
							  
				
  
   
				 if (!($f_saf_ae= mysqli_query($conexion_mysql,$saf_e)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}	
				  
				  $f_safae=mysqli_fetch_array($f_saf_ae);
					  $tota_ae_saf=$f_safae['acumulado'];
	
	$saf_n = "SELECT sum(total) as acumulado
									FROM `analisis_f`
									WHERE `mm` ='$mes'
									AND `aa` ='$ejercicio'
									and entidad ='$saf'
									AND ff !='11'
									
									";
							  
				
  
   
				 if (!($f_saf_an= mysqli_query($conexion_mysql,$saf_n)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}	
				  
				  $f_safan=mysqli_fetch_array($f_saf_an);
					  $tota_an_saf=$f_safan['acumulado'];
	
	/*
	
	$saf_o = "SELECT obs_o
									FROM `analisis_f`
									WHERE `mm` ='$mes'
									AND `aa` ='$ejercicio'
									and entidad ='$saf'
									AND extra='S'
									group by  obs_o
									";
							  
				
  
   
				 if (!($f_saf_ao= mysql_query($saf_o, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}	
				$o=1;  
	$a_obser='';
				While($f_safao=mysql_fetch_array($f_saf_ao)) 
				{
                  $obser=$f_safao['obs_o'];
					
					if($o==1)
					{
						$a_obser=$f_safao['obs_o'];
						$o=2;
					}
						else
						{
							
							$a_obser=utf8_decode($a_obser."; ".$obser);
						}
					
				}
				$o=1;	  
	
	*/
	
	
	
	
				   $dif=$total_l-$tota_an_saf;
				  
				  $total_a=$total_a+$tota_ac_saf;
				  $total_d=$total_d+$dif;
				  
		          $var=$tota_ae_saf*100;
				  $por=$var/$total_l;
				  $english_format_number = number_format($por, 2, '.', '');
	
	
	             $varof=$tota_an_saf*100;
				  $porof=$varof/$total_l;
				  $english_format_number_of = number_format($porof, 2, '.', '');
	
	               $total_e=$total_e+$tota_ae_saf;
	
	
	//$total_n=$total_n+$tota_ae_saf;
	
	$total_n_of=$total_n_of+$tota_an_saf;

	$pdf->SetFont('courier','B',7);
	$pdf->SetY($y_axis);
	
	$pdf->SetX(15);
	$cont=$cont+1;
    $pdf->Cell(10,$r,$saf,1,0,'C',1); 
	$pdf->SetFont('arial','B',6);
	$pdf->Cell(90,$r,strtoupper($denominacion),1,0,'L',1);
	
	$pdf->SetFont('courier','B',8);
    $pdf->Cell(40,$r,number_format($total_l,2, ',', '.'),1,0,'R',1);
	//$pdf->Cell(40,$r,$total_l,1,0,'C',1); 
	$pdf->Cell(40,$r,number_format($tota_ac_saf,2, ',', '.'),1,0,'R',1);
	$pdf->Cell(40,$r,number_format($tota_ae_saf,2, ',', '.'),1,0,'R',1);
	$pdf->Cell(40,$r,number_format($tota_an_saf,2, ',', '.'),1,0,'R',1);
	
	
	
	
	
	
	if($english_format_number>100)
	{
		$pdf->SetFillColor(253, 93, 96);
		$pdf->Cell(20,$r,$english_format_number.' %',1,0,'R',true);
	}
	else
	{
$pdf->SetFillColor(256,256,256);
		$pdf->Cell(20,$r,$english_format_number.' %',1,0,'R',1);
	}
$pdf->SetFillColor(256,256,256);
	
	if($english_format_number_of >100)
	{
		$pdf->SetFillColor(253, 93, 96);
		$pdf->Cell(20,$r,$english_format_number_of.' %',1,0,'R',true);
	}
	else
	{
$pdf->SetFillColor(256,256,256);
		$pdf->Cell(20,$r,$english_format_number_of.' %',1,0,'R',1);
	}
	
	
	
	
	
	
	
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
	
	
		
	

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($y_axis+7); 
$pdf->SetX(15);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','IB',7);
 $pdf->SetX(15);

$pdf->Cell(100,7,'TOTAL GENERAL',1,0,'C',1);
$pdf->Cell(40,7,'LIMITE',1,0,'C',1);

$pdf->Cell(40,7,'ACUMULADO',1,0,'C',1);
$pdf->Cell(40,7,'FUENTE DEL TESORO 11',1,0,'C',1);
$pdf->Cell(40,7,'OTRAS FUENTES',1,0,'C',1);

//$pdf->Cell(25,7,'VARIACION',1,0,'C',1);
$pdf->Cell(20,7,'VARIACION',1,0,'C',1);
$pdf->SetY($y_axis+12);
$pdf->SetX(270);
$pdf->Cell(30,1,'(FF 11)',0,0,'C',0);
$pdf->SetY($y_axis+7);
$pdf->SetX(295);
$pdf->Cell(20,7,'VARIACION',1,0,'C',1);
$pdf->SetY($y_axis+12);
$pdf->SetX(290);
$pdf->Cell(30,1,'(OTRAS FF)',0,0,'C',0);;
//$pdf->Cell(100,7,'OBSERVACION',1,0,'C',1);
$pdf->SetFillColor(256,256,256);
 $pdf->SetFont('courier','IB',9);
$pdf->SetY($y_axis+18); 
$pdf->SetX(30);

$pdf->SetX(110);
$pdf->Cell(40,3,number_format($total_g,2, ',', '.'),0,0,'R',1);
$pdf->SetX(150);
$pdf->Cell(40,3,number_format($total_a,2, ',', '.'),0,0,'R',1);
	$pdf->SetX(190);
$pdf->Cell(40,3,number_format($total_e,2, ',', '.'),0,0,'R',1);
	$pdf->SetX(232);
$pdf->Cell(40,3,number_format($total_n_of,2, ',', '.'),0,0,'R',1);
	$pdf->SetX(275);
	
	
$pdf->Cell(20,3,number_format($total_v,2, ',', '.').' %',0,0,'R',1);
	$pdf->SetX(295);
	
	
$pdf->Cell(20,3,number_format($total_v_of,2, ',', '.').' %',0,0,'R',1);
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
