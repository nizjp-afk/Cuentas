<?php
 error_reporting ( E_ERROR );
   //conexion
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
   // include('conexion/extras.php');
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	 $saf = $_POST['saf'];
	
	
	
	if(!($saf=='N'))
	  {
		 $saf1=substr($saf,0,10);
	
		 $saf2=substr($saf,10,3);
		
		 $saf3=substr($saf,13,1);
		 	
	     $saf=$saf2.'-'.$saf1.'-'.$saf3;

	    
		
		
	  }
	
	
	 $cuenta = $_POST['cuenta'];
	
	
	//$fecha_cons=$_GET['consul'];	
	
	//$max_fecha='2011-11-17';
	
	//$saf='301';
   $fechaant = $_POST['firstinput'];
   $fechahoy = $_POST['secondinput']; 
   $val='0'; 	  
   $max=25;
    $v=0;
   $f=strftime("%Y-%m-%d");
   $dia = date("d/m/Y");
   $hora =date("h:i");

//echo "paso";exit; 		
define('FPDF_FONTPATH','font/');
require('../fpdf.php');

//Connect to your database
//Create new pdf file
$pdf=new FPDF('L','mm','A4');
if(($saf=='N') and ($cuenta=='N'))
  {	
  
	 $ssql = "SELECT DISTINCT `SAF` FROM `saf_escritural` WHERE  ESTADO='A' ORDER BY SAF ";
     if (!($r_saf= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
 while ($f_saf=mysql_fetch_array($r_saf))
     {
	    $saf =$f_saf['SAF'];
		//$den_saf =$f_saf['DENOMINACION'];
		$cuenta =$f_saf['ESCRITURAL'];
		 $tot_saldo=0;
		
		
	 $ssql = "SELECT * FROM escritural AS e,saf_escritural as s where e.saf='$saf' and s.SAF=e.saf
		 group by esc_cuenta order by esc_cuenta Asc ";
     if (!($r_ope= mysql_query($ssql, $conexion_mysql)))
			{
			  
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar area";
			 
			  //.....................................................................
			}
       
	
//////////////fin de consulta en base///////////

//$pdf=new FPDF('P','mm','A4'); // imprime hoja horizontal
//$pdf=new FPDF('P','mm','Legal');//imprime hoja vertical
while ($f_ope=mysql_fetch_array($r_ope))
  {
  $v=0;
 
  $fecha = '';
		  
		  $descripcion ='';
		  
		  $periodo = '';
		 		  
		  $detalle1 = '';
		  
		  $detalle2 = '';
		  
		  $debito = '';
		 
		  $retenciones ='';
		 
		  $credito = '';
		 // $autorizado = $row['saldo'];
		  $codigo = '';
          
		  $Ejercicio =$f_ope['esc_cuenta'];
          
		  $den_saf =$f_ope['nombre_esc'];
   
    $ssql = "SELECT * FROM escritural where saf='$saf'
	           AND fecha >='$fechaant' and fecha <= '$fechahoy'
			  and esc_cuenta='$Ejercicio'
			  and cod_proceso='2'
			  AND `debito` =0
			 ORDER BY fecha asc, `esc_cuenta` ASC,`num_cuenta`  ";
     if (!($r_op= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
	
	
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
$pdf->Image('../img/tgp_01.jpg',10,6,25);
////$pdf->Image('../img/tgp_02.jpg',75,6,10);


$pdf->SetFont('Arial','B',6);
//$pdf->setX(150);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
//$pdf->setY(25);
$pdf->SetY(15);
$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
$pdf->SetY($y_axis_initial+5);
$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);
$pdf->SetY($y_axis_initial+10);
$pdf->SetFont('Arial','B',8);
//$pdf->cell(0,0,'N? Autorizacion: '.$nro,0,'B','R',0);
$y_axis_initial = 20;
$pdf->SetY($y_axis_initial);
$pdf->SetFont('Arial','B',12);
$pdf->SetX(10);
$pdf->cell(0,0,'DETALLE DE CUENTAS RECAUDADORAS ',0,'B','C',0);
$pdf->SetX(10);


//set initial y axis position per page
$y_axis_initial = 30;
$pdf->SetY($y_axis_initial);
$pdf->SetFont('Arial','B',12);
$pdf->SetX(10);
$pdf->cell(0,0,'CUENTA ESCRITURAL N?: '.$Ejercicio,0,'B','L',0);
$pdf->SetX(10);
//$pdf->Cell(0,4,'SOLICITUD DE PAGO SERVICIO DE ADMINISTRACION FINANCIERA '.$saf,'0',0,'L',0);

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',10);
$i=35;
$pdf->SetY($i=$i+3);
$pdf->SetX(10);
$pdf->Cell(0,4,'DENOMINACION: '.$den_saf,'0',0,'L',0);
$pdf->SetY($i=$i+6);
$pdf->SetX(6);
$pdf->Cell(284,4,'','T',0,'L',1);


///////////////////////////////////////////////////////////////////////////////////////

////// DETALLE DEL PRESUPUESTO

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',6);
$pdf->SetY($i=$i+1);
$pdf->SetFillColor(215,215,215);
$pdf->SetX(6);
//$pdf->Cell(10,6,'Saf',1,0,'C',1);
$pdf->Cell(16,6,'Fecha',0,0,'C',1);
$pdf->Cell(50,6,'Cod.        Fte.           Detalle',0,0,'L',1);
$pdf->SetX(72);
$pdf->Cell(17,6,'Cta Nro',0,0,'C',1);
$pdf->SetX(85);
$pdf->Cell(60,6,'Descripcion/Beneficiarios',0,0,'C',1);
$pdf->SetX(130);
$pdf->Cell(70,6,'Observacion',0,0,'C',1);
$pdf->SetX(200);
$pdf->Cell(22,6,'',0,0,'C',1);
$pdf->Cell(22,6,'',0,0,'C',1);
$pdf->Cell(45,6,'Credito',0,0,'C',1);
//$pdf->Cell(25,6,'',0,0,'C',1);
$pdf->SetFillColor(256,256,256);

$pdf->SetY($i=$i+7);
$pdf->SetX(6);
$pdf->Cell(284,6,'','T',0,'L',1);
$aux=='';
//$y_axis=54;
$row_height = 7;
$InterLigne = 4;
mysql_data_seek($r_op,0);
$cant = mysql_num_rows($r_op);
if($cant > 0)
  {
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
		//$pdf->Image('../img/tgp_02.jpg',75,6,10);

		
		$pdf->SetFont('Arial','B',6);
		//$pdf->setX(150);
		// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
		//$pdf->setY(25);
		$pdf->SetY(15);
		/*$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
		$pdf->SetY($y_axis_initial+5);
		$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);
		$pdf->SetY($y_axis_initial+10);
		$pdf->SetFont('Arial','B',8);*/
		//$pdf->cell(0,0,'N? Autorizacion: '.$nroaux,0,'B','R',0);

		
		//set initial y axis position per page
		$y_axis_initial = 30;
		$pdf->SetY($y_axis_initial);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetX(10);
		$pdf->cell(0,0,'CUENTA ESCRITURAL N?: '.$Ejercicio,0,'B','L',0);
		$pdf->SetX(10);
		//$pdf->Cell(0,4,'SOLICITUD DE PAGO SERVICIO DE ADMINISTRACION FINANCIERA '.$saf,'0',0,'L',0);
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',10);
		$i=35;
		$pdf->SetY($i=$i+3);
		$pdf->SetX(10);
		$pdf->Cell(0,4,'DENOMINACION: '.$den_saf,'0',0,'L',0);
		$pdf->SetY($i=$i+6);
		$pdf->SetX(6);
		$pdf->Cell(284,4,'','T',0,'L',1);
		
		
		///////////////////////////////////////////////////////////////////////////////////////
		
		////// DETALLE DEL PRESUPUESTO
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',6);
		$pdf->SetY($i=$i+1);
		$pdf->SetFillColor(215,215,215);
		$pdf->SetX(6);
		//$pdf->Cell(10,6,'Saf',1,0,'C',1);
		$pdf->Cell(16,6,'Fecha',0,0,'C',1);
		$pdf->Cell(50,6,'Cod.        Fte.           Detalle',0,0,'L',1);
		$pdf->SetX(72);
		$pdf->Cell(17,6,'Cta Nro',0,0,'C',1);
		$pdf->SetX(85);
		$pdf->Cell(60,6,'Descripcion/Beneficiarios',0,0,'C',1);
		$pdf->SetX(130);
		$pdf->Cell(70,6,'Observacion',0,0,'C',1);
		$pdf->SetX(200);
		$pdf->Cell(22,6,'',0,0,'C',1);
		$pdf->Cell(22,6,'',0,0,'C',1);
		$pdf->Cell(45,6,'Credito',0,0,'L',1);
	//	$pdf->Cell(25,6,'SALDO',0,0,'C',1);
		$pdf->SetFillColor(256,256,256);
		
		$pdf->SetY($i=$i+7);
		$pdf->SetX(6);
		$pdf->Cell(284,6,'','T',0,'L',1);
		$cp=0;
		//$y_axis=54;
		$row_height = 7;
		$InterLigne = 4;
	}
  
  //If the current row is the last one, create new page and print column title
   
	   
		  
		 
		  $pdf->SetFillColor(256,256,256);
               
		  $pdf->SetFont('courier','',6);
		  
		  $pdf->SetY($i=$i+5);
		  
		  $pdf->SetX(6);
		
			$fecha = $row['fecha'];
		  
		  $descripcion = $row['descripcion'];
		  
		  $periodo = $row['periodo'];
		 		  
		  $detalle1 = substr( $row['detalle_1'],0,45);
		  
		  $detalle2 = substr($row['detalle_2'],0,40);
		  
		  $debito = $row['debito'];
		 
		  $retenciones = $row['retenciones'];
		 
		  $credito = $row['credito'];
		 // $autorizado = $row['saldo'];
		  $codigo = $row['cod_proceso'];
			 $pdf->SetX(6);
		 
			    $pdf->Cell(16,6,$fecha,0,0,'L',1);
		   
	
     	  $pdf->SetFont('courier','',6);
		  
			
			if($codigo==2)
			  {
				  $pdf->Cell(50,6,$descripcion,0,0,'L',1);
				  $pdf->SetX(72);
				  $pdf->Cell(17,6,$periodo,0,0,'L',1);
				   $pdf->SetX(87);
				  $pdf->Cell(60,6,$detalle1,0,0,'L',1);
				  $pdf->Cell(60,6,$detalle2,0,0,'L',1);
				  if($debito > $credito)
				    {
				      $tot_saldo=$tot_saldo-$debito;
					}
				else
				   {
					   $tot_saldo=$tot_saldo+$credito;
				   }
			  }
			 
			
		if(!($codigo==1))
		{
		$pdf->SetX(200);
		$pdf->SetFont('courier','',7);
		$pdf->Cell(20,6,number_format($debito,2),0,0,'R',1);
		$pdf->SetX(220);
		$pdf->Cell(20,6,number_format($retenciones,2),0,0,'R',1);
	    $pdf->SetX(242);
		$pdf->Cell(40,6,number_format($credito,2),0,0,'R',1);
		}
		$pdf->SetX(270);
		
		if(!($codigo==1))
		{
	//		$pdf->Cell(20,6,number_format($tot_saldo,2),0,0,'R',1);
		}
	

	//$pdf->line(15,$y_axis,205,$y_axis); 
        $cp=$cp+1; 
	    $y_axis = $y_axis + $row_height;
		 $tot_debito=$tot_debito+$debito;
		 $tot_credito=$tot_credito+$credito;
		  $tot_retenciones=$tot_retenciones+$retenciones;
	
		
     }
 $pdf->SetY($i=$i+7);
		$pdf->SetX(6);
		$pdf->Cell(284,6,'','T',0,'L',1);
	    $pdf->SetFont('courier','B',8);
		$pdf->SetFillColor(215,215,215);
		
		$fe_dato=split("-",$fechahoy);
		$fe_con=$fe_dato[2].'-'.$fe_dato[1].'-'.$fe_dato[0];
  	   
	    $tot_gral_saldo=$tot_gral_saldo+$tot_saldo;
	    
		
	$aux=0;
        $pdf->SetY($i=$i+5);
		$pdf->SetX(6);  
		$pdf->Cell(100,6,'TOTALES CONTABLE AL '.$fe_con.':',0,0,'R',1);
		$pdf->Cell(100,6,'',0,0,'R',1);
		$pdf->SetX(200);
		$pdf->Cell(21,6,'',0,0,'R',1);
		$pdf->SetX(220);
		$pdf->Cell(21,6,'',0,0,'R',1);
	    $pdf->SetX(238);
		$pdf->Cell(45,6,number_format($tot_credito,2),0,0,'R',1);
		//$pdf->SetX(270);
		//$pdf->Cell(21,6,number_format($tot_gral_saldo,2),0,0,'R',1);
		//////////////////////////////////////////////////////////////////////////////////////////////
		
    $tot_saldo_gral=$tot_saldo_gral +$tot_gral_saldo;
	$total_debito=$total_debito+$tot_debito;
	$total_credito=$total_credito+$tot_credito;
	$total_retenciones=$total_retenciones+$tot_retenciones;
	$tot_debito=0;
	$tot_credito=0;
	$tot_retenciones=0;

  }

  }
 }
 
		
		$fe_dato=split("-",$fechahoy);
		$fe_con=$fe_dato[2].'-'.$fe_dato[1].'-'.$fe_dato[0];
  	   
	    $tot_gral_saldo=$tot_gral_saldo+$tot_saldo;
	    
		
		$aux=0;



  }
 elseif(($saf!='N') and ($cuenta=='N'))
  {
	 $ssql = "SELECT * FROM escritural AS e,saf_escritural as s where e.esc_cuenta='$saf' and s.SAF=e.saf
	          AND ESTADO='A' 
	 group by esc_cuenta order by esc_cuenta Asc ";
     if (!($r_ope= mysql_query($ssql, $conexion_mysql)))
			{
			  
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar area";
			 
			  //.....................................................................
			}
       
	
//////////////fin de consulta en base///////////

//$pdf=new FPDF('P','mm','A4'); // imprime hoja horizontal
//$pdf=new FPDF('P','mm','Legal');//imprime hoja vertical
while ($f_ope=mysql_fetch_array($r_ope))
  {
$v=0;
 
  $fecha = '';
		  
		  $descripcion ='';
		  
		  $periodo = '';
		 		  
		  $detalle1 = '';
		  
		  $detalle2 = '';
		  
		  $debito = '';
		 
		  $retenciones ='';
		 
		  $credito = '';
		 // $autorizado = $row['saldo'];
		  $codigo = '';
          
		   $saf =$f_ope['saf'];
		  
		  $Ejercicio =$f_ope['esc_cuenta'];
          
		  $den_saf =$f_ope['nombre_esc'];
   
    $ssql = "SELECT * FROM escritural where saf='$saf'
	           AND fecha >='$fechaant' and fecha <= '$fechahoy'
			  and esc_cuenta='$Ejercicio'
			  and cod_proceso='2'
			  AND `debito` =0
			 ORDER BY fecha asc,`esc_cuenta` ASC,`num_cuenta`  ";
     if (!($r_op= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
	
	
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
$pdf->Image('../img/tgp_01.jpg',10,6,25);
////$pdf->Image('../img/tgp_02.jpg',75,6,10);


$pdf->SetFont('Arial','B',6);
//$pdf->setX(150);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
//$pdf->setY(25);
$pdf->SetY(15);
$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
$pdf->SetY($y_axis_initial+5);
$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);
$pdf->SetY($y_axis_initial+10);
$pdf->SetFont('Arial','B',8);
//$pdf->cell(0,0,'N? Autorizacion: '.$nro,0,'B','R',0);
$y_axis_initial = 20;
$pdf->SetY($y_axis_initial);
$pdf->SetFont('Arial','B',12);
$pdf->SetX(10);
$pdf->cell(0,0,'DETALLE DE CUENTAS RECAUDADORAS ',0,'B','C',0);
$pdf->SetX(10);


//set initial y axis position per page
$y_axis_initial = 30;
$pdf->SetY($y_axis_initial);
$pdf->SetFont('Arial','B',12);
$pdf->SetX(10);
$pdf->cell(0,0,'CUENTA ESCRITURAL N?: '.$Ejercicio,0,'B','L',0);
$pdf->SetX(10);
//$pdf->Cell(0,4,'SOLICITUD DE PAGO SERVICIO DE ADMINISTRACION FINANCIERA '.$saf,'0',0,'L',0);

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',10);
$i=35;
$pdf->SetY($i=$i+3);
$pdf->SetX(10);
$pdf->Cell(0,4,'DENOMINACION: '.$den_saf,'0',0,'L',0);
$pdf->SetY($i=$i+6);
$pdf->SetX(6);
$pdf->Cell(284,4,'','T',0,'L',1);


///////////////////////////////////////////////////////////////////////////////////////

////// DETALLE DEL PRESUPUESTO

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',6);
$pdf->SetY($i=$i+1);
$pdf->SetFillColor(215,215,215);
$pdf->SetX(6);
//$pdf->Cell(10,6,'Saf',1,0,'C',1);
$pdf->Cell(16,6,'Fecha',0,0,'C',1);
$pdf->Cell(50,6,'Cod.        Fte.           Detalle',0,0,'L',1);
$pdf->SetX(72);
$pdf->Cell(17,6,'Cta Nro',0,0,'C',1);
$pdf->SetX(85);
$pdf->Cell(60,6,'Descripcion/Beneficiarios',0,0,'C',1);
$pdf->SetX(130);
$pdf->Cell(70,6,'Observacion',0,0,'C',1);
$pdf->SetX(200);
$pdf->Cell(22,6,'',0,0,'C',1);
$pdf->Cell(22,6,'',0,0,'C',1);
$pdf->Cell(45,6,'Credito',0,0,'C',1);
//$pdf->Cell(25,6,'',0,0,'C',1);
$pdf->SetFillColor(256,256,256);

$pdf->SetY($i=$i+7);
$pdf->SetX(6);
$pdf->Cell(284,6,'','T',0,'L',1);
$aux=='';
//$y_axis=54;
$row_height = 7;
$InterLigne = 4;
mysql_data_seek($r_op,0);
$cant = mysql_num_rows($r_op);
if($cant > 0)
  {
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
		//$pdf->Image('../img/tgp_02.jpg',75,6,10);

		
		$pdf->SetFont('Arial','B',6);
		//$pdf->setX(150);
		// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
		//$pdf->setY(25);
		$pdf->SetY(15);
		/*$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
		$pdf->SetY($y_axis_initial+5);
		$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);
		$pdf->SetY($y_axis_initial+10);
		$pdf->SetFont('Arial','B',8);*/
		//$pdf->cell(0,0,'N? Autorizacion: '.$nroaux,0,'B','R',0);

		
		//set initial y axis position per page
		$y_axis_initial = 30;
		$pdf->SetY($y_axis_initial);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetX(10);
		$pdf->cell(0,0,'CUENTA ESCRITURAL N?: '.$Ejercicio,0,'B','L',0);
		$pdf->SetX(10);
		//$pdf->Cell(0,4,'SOLICITUD DE PAGO SERVICIO DE ADMINISTRACION FINANCIERA '.$saf,'0',0,'L',0);
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',10);
		$i=35;
		$pdf->SetY($i=$i+3);
		$pdf->SetX(10);
		$pdf->Cell(0,4,'DENOMINACION: '.$den_saf,'0',0,'L',0);
		$pdf->SetY($i=$i+6);
		$pdf->SetX(6);
		$pdf->Cell(284,4,'','T',0,'L',1);
		
		
		///////////////////////////////////////////////////////////////////////////////////////
		
		////// DETALLE DEL PRESUPUESTO
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',6);
		$pdf->SetY($i=$i+1);
		$pdf->SetFillColor(215,215,215);
		$pdf->SetX(6);
		//$pdf->Cell(10,6,'Saf',1,0,'C',1);
		$pdf->Cell(16,6,'Fecha',0,0,'C',1);
		$pdf->Cell(50,6,'Cod.        Fte.           Detalle',0,0,'L',1);
		$pdf->SetX(72);
		$pdf->Cell(17,6,'Cta Nro',0,0,'C',1);
		$pdf->SetX(85);
		$pdf->Cell(60,6,'Descripcion/Beneficiarios',0,0,'C',1);
		$pdf->SetX(130);
		$pdf->Cell(70,6,'Observacion',0,0,'C',1);
		$pdf->SetX(200);
		$pdf->Cell(22,6,'',0,0,'C',1);
		$pdf->Cell(22,6,'',0,0,'C',1);
		$pdf->Cell(45,6,'Credito',0,0,'L',1);
	//	$pdf->Cell(25,6,'SALDO',0,0,'C',1);
		$pdf->SetFillColor(256,256,256);
		
		$pdf->SetY($i=$i+7);
		$pdf->SetX(6);
		$pdf->Cell(284,6,'','T',0,'L',1);
		$cp=0;
		//$y_axis=54;
		$row_height = 7;
		$InterLigne = 4;
	}
  
  //If the current row is the last one, create new page and print column title
   
	   
		  
		 
		  $pdf->SetFillColor(256,256,256);
               
		  $pdf->SetFont('courier','',6);
		  
		  $pdf->SetY($i=$i+5);
		  
		  $pdf->SetX(6);
		
			$fecha = $row['fecha'];
		  
		  $descripcion = $row['descripcion'];
		  
		  $periodo = $row['periodo'];
		 		  
		  $detalle1 = substr( $row['detalle_1'],0,45);
		  
		  $detalle2 = substr($row['detalle_2'],0,40);
		  
		  $debito = $row['debito'];
		 
		  $retenciones = $row['retenciones'];
		 
		  $credito = $row['credito'];
		 // $autorizado = $row['saldo'];
		  $codigo = $row['cod_proceso'];
			 $pdf->SetX(6);
		 
			    $pdf->Cell(16,6,$fecha,0,0,'L',1);
		   
	
     	  $pdf->SetFont('courier','',6);
		  
			
			if($codigo==2)
			  {
				  $pdf->Cell(50,6,$descripcion,0,0,'L',1);
				  $pdf->SetX(72);
				  $pdf->Cell(17,6,$periodo,0,0,'L',1);
				   $pdf->SetX(87);
				  $pdf->Cell(60,6,$detalle1,0,0,'L',1);
				  $pdf->Cell(60,6,$detalle2,0,0,'L',1);
				  if($debito > $credito)
				    {
				      $tot_saldo=$tot_saldo-$debito;
					}
				else
				   {
					   $tot_saldo=$tot_saldo+$credito;
				   }
			  }
			 
			
		if(!($codigo==1))
		{
		$pdf->SetX(200);
		$pdf->SetFont('courier','',7);
		$pdf->Cell(20,6,number_format($debito,2),0,0,'R',1);
		$pdf->SetX(220);
		$pdf->Cell(20,6,number_format($retenciones,2),0,0,'R',1);
	    $pdf->SetX(242);
		$pdf->Cell(40,6,number_format($credito,2),0,0,'R',1);
		}
		$pdf->SetX(270);
		
		if(!($codigo==1))
		{
	//		$pdf->Cell(20,6,number_format($tot_saldo,2),0,0,'R',1);
		}
	

	//$pdf->line(15,$y_axis,205,$y_axis); 
        $cp=$cp+1; 
	    $y_axis = $y_axis + $row_height;
		 $tot_debito=$tot_debito+$debito;
		 $tot_credito=$tot_credito+$credito;
		  $tot_retenciones=$tot_retenciones+$retenciones;
	
		
     }
 $pdf->SetY($i=$i+7);
		$pdf->SetX(6);
		$pdf->Cell(284,6,'','T',0,'L',1);
	    $pdf->SetFont('courier','B',8);
		$pdf->SetFillColor(215,215,215);
		
		$fe_dato=split("-",$fechahoy);
		$fe_con=$fe_dato[2].'-'.$fe_dato[1].'-'.$fe_dato[0];

  	   
	    $tot_gral_saldo=$tot_gral_saldo+$tot_saldo;
	    
		
	$aux=0;
        $pdf->SetY($i=$i+5);
		$pdf->SetX(6);  
		$pdf->Cell(100,6,'TOTALES CONTABLE AL '.$fe_con.':',0,0,'R',1);
		$pdf->Cell(100,6,'',0,0,'R',1);
		$pdf->SetX(200);
		$pdf->Cell(21,6,'',0,0,'R',1);
		$pdf->SetX(220);
		$pdf->Cell(21,6,'',0,0,'R',1);
	    $pdf->SetX(238);
		$pdf->Cell(45,6,number_format($tot_credito,2),0,0,'R',1);
		//$pdf->SetX(270);
		//$pdf->Cell(21,6,number_format($tot_gral_saldo,2),0,0,'R',1);
		//////////////////////////////////////////////////////////////////////////////////////////////
		
    $tot_saldo_gral=$tot_saldo_gral +$tot_gral_saldo;
	$total_debito=$total_debito+$tot_debito;
	$total_credito=$total_credito+$tot_credito;
	$total_retenciones=$total_retenciones+$tot_retenciones;
	$tot_debito=0;
	$tot_credito=0;
	$tot_retenciones=0;

  }

  }
 
 
  }
		

  
	 elseif(($saf!='N') and ($cuenta!='N'))
  {
	 $ssql = "SELECT * FROM escritural AS e,saf_escritural as s where e.esc_cuenta='$saf' and s.SAF=e.saf
	          AND ESTADO='A' 
	 group by esc_cuenta order by esc_cuenta Asc ";
     if (!($r_ope= mysql_query($ssql, $conexion_mysql)))
			{
			  
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar area";
			 
			  //.....................................................................
			}
       
	
//////////////fin de consulta en base///////////

//$pdf=new FPDF('P','mm','A4'); // imprime hoja horizontal
//$pdf=new FPDF('P','mm','Legal');//imprime hoja vertical
while ($f_ope=mysql_fetch_array($r_ope))
  {
$v=0;
 
  $fecha = '';
		  
		  $descripcion ='';
		  
		  $periodo = '';
		 		  
		  $detalle1 = '';
		  
		  $detalle2 = '';
		  
		  $debito = '';
		 
		  $retenciones ='';
		 
		  $credito = '';
		 // $autorizado = $row['saldo'];
		  $codigo = '';
          
		   $saf =$f_ope['saf'];
		  
		  $Ejercicio =$f_ope['esc_cuenta'];
          
		  $den_saf =$f_ope['nombre_esc'];
   
    $ssql = "SELECT * FROM escritural where saf='$saf'
	           AND fecha >='$fechaant' and fecha <= '$fechahoy'
			  and esc_cuenta='$Ejercicio'
			  and cod_proceso='2'
			   and num_cuenta='$cuenta'
			  AND `debito` =0
			 ORDER BY fecha asc,`esc_cuenta` ASC,`num_cuenta`";
     if (!($r_op= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
	
	
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
$pdf->Image('../img/tgp_01.jpg',10,6,25);
////$pdf->Image('../img/tgp_02.jpg',75,6,10);


$pdf->SetFont('Arial','B',6);
//$pdf->setX(150);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
//$pdf->setY(25);
$pdf->SetY(15);
$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
$pdf->SetY($y_axis_initial+5);
$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);
$pdf->SetY($y_axis_initial+10);
$pdf->SetFont('Arial','B',8);
//$pdf->cell(0,0,'N? Autorizacion: '.$nro,0,'B','R',0);
$y_axis_initial = 20;
$pdf->SetY($y_axis_initial);
$pdf->SetFont('Arial','B',12);
$pdf->SetX(10);
$pdf->cell(0,0,'DETALLE DE CUENTAS RECAUDADORAS ',0,'B','C',0);
$pdf->SetX(10);


//set initial y axis position per page
$y_axis_initial = 30;
$pdf->SetY($y_axis_initial);
$pdf->SetFont('Arial','B',12);
$pdf->SetX(10);
$pdf->cell(0,0,'CUENTA ESCRITURAL N?: '.$Ejercicio,0,'B','L',0);
$pdf->SetX(10);
//$pdf->Cell(0,4,'SOLICITUD DE PAGO SERVICIO DE ADMINISTRACION FINANCIERA '.$saf,'0',0,'L',0);

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',10);
$i=35;
$pdf->SetY($i=$i+3);
$pdf->SetX(10);
$pdf->Cell(0,4,'DENOMINACION: '.$den_saf,'0',0,'L',0);
$pdf->SetY($i=$i+6);
$pdf->SetX(6);
$pdf->Cell(284,4,'','T',0,'L',1);


///////////////////////////////////////////////////////////////////////////////////////

////// DETALLE DEL PRESUPUESTO

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',6);
$pdf->SetY($i=$i+1);
$pdf->SetFillColor(215,215,215);
$pdf->SetX(6);
//$pdf->Cell(10,6,'Saf',1,0,'C',1);
$pdf->Cell(16,6,'Fecha',0,0,'C',1);
$pdf->Cell(50,6,'Cod.        Fte.           Detalle',0,0,'L',1);
$pdf->SetX(72);
$pdf->Cell(17,6,'Cta Nro',0,0,'C',1);
$pdf->SetX(85);
$pdf->Cell(60,6,'Descripcion/Beneficiarios',0,0,'C',1);
$pdf->SetX(130);
$pdf->Cell(70,6,'Observacion',0,0,'C',1);
$pdf->SetX(200);
$pdf->Cell(22,6,'',0,0,'C',1);
$pdf->Cell(22,6,'',0,0,'C',1);
$pdf->Cell(45,6,'Credito',0,0,'C',1);
//$pdf->Cell(25,6,'',0,0,'C',1);
$pdf->SetFillColor(256,256,256);

$pdf->SetY($i=$i+7);
$pdf->SetX(6);
$pdf->Cell(284,6,'','T',0,'L',1);
$aux=='';
//$y_axis=54;
$row_height = 7;
$InterLigne = 4;
mysql_data_seek($r_op,0);
$cant = mysql_num_rows($r_op);
if($cant > 0)
  {
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
		//$pdf->Image('../img/tgp_02.jpg',75,6,10);

		
		$pdf->SetFont('Arial','B',6);
		//$pdf->setX(150);
		// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
		//$pdf->setY(25);
		$pdf->SetY(15);
		/*$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
		$pdf->SetY($y_axis_initial+5);
		$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);
		$pdf->SetY($y_axis_initial+10);
		$pdf->SetFont('Arial','B',8);*/
		//$pdf->cell(0,0,'N? Autorizacion: '.$nroaux,0,'B','R',0);

		
		//set initial y axis position per page
		$y_axis_initial = 30;
		$pdf->SetY($y_axis_initial);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetX(10);
		$pdf->cell(0,0,'CUENTA ESCRITURAL N?: '.$Ejercicio,0,'B','L',0);
		$pdf->SetX(10);
		//$pdf->Cell(0,4,'SOLICITUD DE PAGO SERVICIO DE ADMINISTRACION FINANCIERA '.$saf,'0',0,'L',0);
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',10);
		$i=35;
		$pdf->SetY($i=$i+3);
		$pdf->SetX(10);
		$pdf->Cell(0,4,'DENOMINACION: '.$den_saf,'0',0,'L',0);
		$pdf->SetY($i=$i+6);
		$pdf->SetX(6);
		$pdf->Cell(284,4,'','T',0,'L',1);
		
		
		///////////////////////////////////////////////////////////////////////////////////////
		
		////// DETALLE DEL PRESUPUESTO
		
		$pdf->SetFillColor(256,256,256);
		$pdf->SetFont('Arial','B',6);
		$pdf->SetY($i=$i+1);
		$pdf->SetFillColor(215,215,215);
		$pdf->SetX(6);
		//$pdf->Cell(10,6,'Saf',1,0,'C',1);
		$pdf->Cell(16,6,'Fecha',0,0,'C',1);
		$pdf->Cell(50,6,'Cod.        Fte.           Detalle',0,0,'L',1);
		$pdf->SetX(72);
		$pdf->Cell(17,6,'Cta Nro',0,0,'C',1);
		$pdf->SetX(85);
		$pdf->Cell(60,6,'Descripcion/Beneficiarios',0,0,'C',1);
		$pdf->SetX(130);
		$pdf->Cell(70,6,'Observacion',0,0,'C',1);
		$pdf->SetX(200);
		$pdf->Cell(22,6,'',0,0,'C',1);
		$pdf->Cell(22,6,'',0,0,'C',1);
		$pdf->Cell(45,6,'Credito',0,0,'L',1);
	//	$pdf->Cell(25,6,'SALDO',0,0,'C',1);
		$pdf->SetFillColor(256,256,256);
		
		$pdf->SetY($i=$i+7);
		$pdf->SetX(6);
		$pdf->Cell(284,6,'','T',0,'L',1);
		$cp=0;
		//$y_axis=54;
		$row_height = 7;
		$InterLigne = 4;
	}
  
  //If the current row is the last one, create new page and print column title
   
	   
		  
		 
		  $pdf->SetFillColor(256,256,256);
               
		  $pdf->SetFont('courier','',6);
		  
		  $pdf->SetY($i=$i+5);
		  
		  $pdf->SetX(6);
		
			$fecha = $row['fecha'];
		  
		  $descripcion = $row['descripcion'];
		  
		  $periodo = $row['periodo'];
		 		  
		  $detalle1 = substr( $row['detalle_1'],0,45);
		  
		  $detalle2 = substr($row['detalle_2'],0,40);
		  
		  $debito = $row['debito'];
		 
		  $retenciones = $row['retenciones'];
		 
		  $credito = $row['credito'];
		 // $autorizado = $row['saldo'];
		  $codigo = $row['cod_proceso'];
			 $pdf->SetX(6);
		 
			    $pdf->Cell(16,6,$fecha,0,0,'L',1);
		   
	
     	  $pdf->SetFont('courier','',6);
		  
			
			if($codigo==2)
			  {
				  $pdf->Cell(50,6,$descripcion,0,0,'L',1);
				  $pdf->SetX(72);
				  $pdf->Cell(17,6,$periodo,0,0,'L',1);
				   $pdf->SetX(87);
				  $pdf->Cell(60,6,$detalle1,0,0,'L',1);
				  $pdf->Cell(60,6,$detalle2,0,0,'L',1);
				  if($debito > $credito)
				    {
				      $tot_saldo=$tot_saldo-$debito;
					}
				else
				   {
					   $tot_saldo=$tot_saldo+$credito;
				   }
			  }
			 
			
		if(!($codigo==1))
		{
		$pdf->SetX(200);
		$pdf->SetFont('courier','',7);
		$pdf->Cell(20,6,number_format($debito,2),0,0,'R',1);
		$pdf->SetX(220);
		$pdf->Cell(20,6,number_format($retenciones,2),0,0,'R',1);
	    $pdf->SetX(242);
		$pdf->Cell(40,6,number_format($credito,2),0,0,'R',1);
		}
		$pdf->SetX(270);
		
		if(!($codigo==1))
		{
	//		$pdf->Cell(20,6,number_format($tot_saldo,2),0,0,'R',1);
		}
	

	//$pdf->line(15,$y_axis,205,$y_axis); 
        $cp=$cp+1; 
	    $y_axis = $y_axis + $row_height;
		 $tot_debito=$tot_debito+$debito;
		 $tot_credito=$tot_credito+$credito;
		  $tot_retenciones=$tot_retenciones+$retenciones;
	
		
     }
 $pdf->SetY($i=$i+7);
		$pdf->SetX(6);
		$pdf->Cell(284,6,'','T',0,'L',1);
	    $pdf->SetFont('courier','B',8);
		$pdf->SetFillColor(215,215,215);
		
		$fe_dato=split("-",$fechahoy);
		$fe_con=$fe_dato[2].'-'.$fe_dato[1].'-'.$fe_dato[0];

  	   
	    $tot_gral_saldo=$tot_gral_saldo+$tot_saldo;
	    
		
	$aux=0;
        $pdf->SetY($i=$i+5);
		$pdf->SetX(6);  
		$pdf->Cell(100,6,'TOTALES CONTABLE AL '.$fe_con.':',0,0,'R',1);
		$pdf->Cell(100,6,'',0,0,'R',1);
		$pdf->SetX(200);
		$pdf->Cell(21,6,'',0,0,'R',1);
		$pdf->SetX(220);
		$pdf->Cell(21,6,'',0,0,'R',1);
	    $pdf->SetX(238);
		$pdf->Cell(45,6,number_format($tot_credito,2),0,0,'R',1);
		//$pdf->SetX(270);
		//$pdf->Cell(21,6,number_format($tot_gral_saldo,2),0,0,'R',1);
		//////////////////////////////////////////////////////////////////////////////////////////////
		
    $tot_saldo_gral=$tot_saldo_gral +$tot_gral_saldo;
	$total_debito=$total_debito+$tot_debito;
	$total_credito=$total_credito+$tot_credito;
	$total_retenciones=$total_retenciones+$tot_retenciones;
	$tot_debito=0;
	$tot_credito=0;
	$tot_retenciones=0;

  }

  }
 
 
  }
		$fe_dato=split("-",$fechahoy);
		$fe_con=$fe_dato[2].'-'.$fe_dato[1].'-'.$fe_dato[0];
  	   
	    $tot_gral_saldo=$tot_gral_saldo+$tot_saldo;
	    
		
		$aux=0;

  
	
		
  
   
$pdf->Output();



