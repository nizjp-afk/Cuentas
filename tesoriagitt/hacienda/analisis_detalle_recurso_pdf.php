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
	//$mes = $_GET['mm'];
	$ejercicio = $_GET['aa'];   
	
	
	
	///////////////////
	
   $f=strftime("%Y-%m-%d");
   $dia = date("d/m/Y");
   $hora =date("h:i");
   
    
   
   ////////////////////////////
	
    $_pagi_sql = "SELECT *
FROM `cuentas_recaudacion`
ORDER BY `titular` , `ffin` ";
							  
							  
				
  
   
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

 $total_mes= array(0,0,0,0,0,0,0,0,0,0,0,0);
			  
		

 	
					$fecha_ac = "SELECT MAX( `fecha` ) as fecha_ac FROM `cuenta_ingreso`
              WHERE `aa` ='$ejercicio' ";
							  
				 
   
				 if (!($fecha_ac_res= mysqli_query($conexion_mysql,$fecha_ac)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}		
 $f_ultact = mysqli_fetch_array ($fecha_ac_res);
 
  

$fecha_ua = date("d-m-Y", strtotime($f_ultact['fecha_ac']));

 $fecha_m=date("m", strtotime($f_ultact['fecha_ac']))+1;  


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
$pdf->cell(0,0,'ANALISIS RECAUDACION MENSUAL POR FUENTE DE FINANCIAMIENTO '.strtoupper($meses{$nombre_mes-1}).', '.$ejercicio,0,'B','C',0);
$pdf->SetFont('Arial','IB',7);
$pdf->setY(35);
$pdf->SetX(140);
$pdf->cell(0,0,'ULTIMA ACTUALIZACION  '.$fecha_ua,0,'B','C',0);


$y_axis_initial = 40;

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',7);
$pdf->SetY($y_axis_initial);
$pdf->SetX(3);
$pdf->Cell(10,7,'SAF',1,0,'C',1);
//$pdf->Cell(80,7,'DENOMINACION',1,0,'C',1);
$pdf->Cell(25,7,'CUENTA',1,0,'C',1);

$pdf->Cell(7,7,'FFiN',1,0,'C',1);
//$pdf->Cell(30,7,'EXCEPCIONES',1,0,'C',1);

$pdf->Cell(45,7,'DENOMINACION ',1,0,'C',1);

for ($i=1;$i< $fecha_m;$i++)
                                {
                                $meshtml= $i; 
	if ($i<10) {$meshtml= "0".$i;}
$pdf->Cell(22,7,$meses{$i-1},1,0,'C',1);
	
	
                                } 



$i = 0;

//Set maximum rows per page
$max = 22;
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
$pdf->cell(0,0,'ANALISIS RECAUDACION MENSUAL POR FUENTE DE FINANCIAMIENTO '.strtoupper($meses{$nombre_mes-1}).', '.$ejercicio,0,'B','C',0);
$pdf->SetFont('Arial','IB',7);
$pdf->setY(35);
$pdf->SetX(140);
$pdf->cell(0,0,'ULTIMA ACTUALIZACION  '.$fecha_ua,0,'B','C',0);


$y_axis_initial = 40;

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',7);
$pdf->SetY($y_axis_initial);
$pdf->SetX(3);
$pdf->Cell(10,7,'SAF',1,0,'C',1);
//$pdf->Cell(80,7,'DENOMINACION',1,0,'C',1);
$pdf->Cell(25,7,'CUENTA',1,0,'C',1);

$pdf->Cell(7,7,'FFiN',1,0,'C',1);
//$pdf->Cell(30,7,'EXCEPCIONES',1,0,'C',1);

$pdf->Cell(45,7,'DENOMINACION ',1,0,'C',1);

for ($j=1;$j< $fecha_m;$j++)
                                {
                                $meshtml= $i; 
	if ($j<10) {$meshtml= "0".$i;}
$pdf->Cell(22,7,$meses{$j-1},1,0,'C',1);
	
	
                                } 

			$i = 0;
			
			//Set maximum rows per page
			//$max = 200;
			$y_axis=50;
			//Set Row Height
			//$row_height = 7;
			
//$ir=$i;

	 
        //Set $i variable to 0 (first row)
        
    }

                $saf=$f_limit['titular'];
				  $cuenta= $f_limit['banco'].'-'.$f_limit['sucursal'].'-'.$f_limit['cuenta'];
				  
				   $b= $f_limit['banco'];
				   $s= $f_limit['sucursal'];
				   $c= $f_limit['cuenta'];
				  
				   $ffin=$f_limit['ffin'];
				  $denominacion=$f_limit['denominacion'];
				  
	
	
  $saf_acc = "SELECT  sum( monto ) AS acumulado
									FROM `cuenta_ingreso`
									WHERE `cuenta` ='$c'
									and `sucursal` ='$s'
									and `banco` ='$b'
									
									";
				
					if (!($f_saf_acc= mysqli_query($conexion_mysql,$saf_acc)))
									{
									  //.....................................................................
									  // informa del error producido
									  $cuerpo1  = "al intentar buscar area";

									  //.....................................................................
									}	
		             $f_safacc=mysqli_fetch_array($f_saf_acc);
		
					
				     $total_ac_saf_c=$f_safacc['acumulado'];
	
   
			
	if($total_ac_saf_c>0)
	
	{
	$pdf->SetFont('courier','B',7);
	$pdf->SetY($y_axis);
	
	$pdf->SetX(3);
	$cont=$cont+1;
    $pdf->Cell(10,$r,$saf,1,0,'C',1); 
	$pdf->Cell(25,$r,$cuenta,1,0,'L',1); 
	$pdf->Cell(7,$r,$ffin,1,0,'C',1); 
	$pdf->SetFont('arial','B',6);
	$pdf->Cell(45,$r,$denominacion,1,0,'L',1); 
	for ($j=1;$j< $fecha_m;$j++)
                                {
                                $meshtml= $j; 
		
		         $saf_ac = "SELECT  sum( monto ) AS acumulado, MONTH( FECHA ) AS mm
									FROM `cuenta_ingreso`
									WHERE `cuenta` ='$c'
									and `sucursal` ='$s'
									and `banco` ='$b'
									and MONTH(FECHA)='$j'
									GROUP BY MONTH( FECHA )
									";
				
					if (!($f_saf_ac= mysqli_query($conexion_mysql,$saf_ac)))
									{
									  //.....................................................................
									  // informa del error producido
									  $cuerpo1  = "al intentar buscar area";

									  //.....................................................................
									}	
		             $f_safac=mysqli_fetch_array($f_saf_ac);
		
					
				     $total_ac_saf_m=$f_safac['acumulado'];
		            
		        $total_mes{$j-1}=$total_mes{$j-1}+$f_safac['acumulado'];
	                
		        
		
	if ($total_ac_saf_m >0)
		{
        $pdf->Cell(22,$r,number_format($total_ac_saf_m,2, ',', '.'),1,0,'R',1);
	
	
       }
		else
		{
			$pdf->Cell(22,$r,'-',1,0,'R',1);
		}
	
		
	}
	
	
	               
	
	//Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
	
	//$total_a=$total_a+$tota_ac_saf;
		//		  $total_d=$total_d+$dif;
	//$total_g=$total_g+$total_l;
	
}
}
	
	


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
$pdf->cell(0,0,'ANALISIS RECAUDACION MENSUAL POR FUENTE DE FINANCIAMIENTO '.strtoupper($meses{$nombre_mes-1}).', '.$ejercicio,0,'B','C',0);
$pdf->SetFont('Arial','IB',7);
$pdf->setY(35);
$pdf->SetX(140);
$pdf->cell(0,0,'ULTIMA ACTUALIZACION  '.$fecha_ua,0,'B','C',0);


$y_axis_initial = 40;

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',7);
$pdf->SetY($y_axis_initial);
$pdf->SetX(3);
$pdf->Cell(10,7,'SAF',1,0,'C',1);
//$pdf->Cell(80,7,'DENOMINACION',1,0,'C',1);
$pdf->Cell(35,7,'CUENTA',1,0,'C',1);

$pdf->Cell(7,7,'FFiN',1,0,'C',1);
//$pdf->Cell(30,7,'EXCEPCIONES',1,0,'C',1);

$pdf->Cell(35,7,'DENOMINACION ',1,0,'C',1);

for ($i=1;$i< $fecha_m;$i++)
                                {
                                $meshtml= $i; 
	if ($i<10) {$meshtml= "0".$i;}
$pdf->Cell(22,7,$meses{$i-1},1,0,'C',1);
	
	
                                } 

			$i = 0;
			
			
			//Set maximum rows per page
			//$max = 200;
			$y_axis=50;
			//Set Row Height
			$row_height = 7;
			
$pdf->SetY($y_axis);
	$pdf->SetX(90);
	

	
for ($j=1;$j< $fecha_m;$j++)
                                {
                               
//$pdf->Cell(22,7,$total_mes{$j-1},1,0,'L',1);
	
	 $pdf->Cell(22,$r,number_format($total_mes{$j-1},2, ',', '.'),1,0,'R',1);
	
                                } 	
	
	



}
else
{
	$pdf->SetX(100);
	$pdf->SetY($y_axis+7);

	
for ($j=1;$j< $fecha_m;$j++)
                                {
                                $meshtml= $i; 
	if ($j<10) {$meshtml= "0".$i;}
$pdf->Cell(22,7,$meses{$j-1},1,0,'C',1);
	
	
	
                                } 	
	
$pdf->SetX(80);
	$pdf->SetY($y_axis+14);

	
for ($j=1;$j< $fecha_m;$j++)
                                {
                             
	

	$pdf->Cell(22,3,number_format($total_m{$j},2, ',', '.'),0,0,'R',1);
	
	
                                } 	


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
