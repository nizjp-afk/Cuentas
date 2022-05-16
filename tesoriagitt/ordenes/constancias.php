<?php
error_reporting ( E_ERROR );     

    include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
	

/*
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
 */
	$fechaant = $_GET['fechad'];
    $fechahoy = $_GET['fechah'];  
	$id = $_GET['id'];
    $hora = date("H:i:s",(time()-1*3600));
    $f=strftime("%Y-%m-%d");
    $dia = date("d/m/Y");
    $hora =date("h:i");
	
	$dato=split("-",$fechaant);
	$dato1=split("-",$fechahoy);
	
	$ant=$dato[2].'-'.$dato[1].'-'.$dato[0];
	$hoy=$dato1[2].'-'.$dato1[1].'-'.$dato1[0];
	
	$ssql = "SELECT *
FROM `codigo_retencion` ";
     if (!($r_codigo= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar codigo";
      echo $cuerpo1;
      //.....................................................................
    }    
	
	$ssql = "SELECT *
FROM `ret_esidif` ";
     if (!($r_e_codigo= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar codigo";
      echo $cuerpo1;
      //.....................................................................
    }    
	$ssql = "SELECT * FROM `beneficiarios_aprobados` WHERE id_beneficiario='$id'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar beneficiario";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_beneficiario= mysql_fetch_array ($r_beneficiario);

	   
  $cuitl = $f_beneficiario['cuitl'];
  $ape = $f_beneficiario['apellido'];  
  $nom = $f_beneficiario['nombre'];  
  $razon_social = $f_beneficiario['razon_social'];  
 
 
  $ingreso_bruto = $f_beneficiario['ingreso_bruto'];
  $iva_situacion = $f_beneficiario['iva_situacion'];
  $ganancia = $f_beneficiario['ganancia'];
  $ingreso = $f_beneficiario['ingreso'];
  $regimen = $f_beneficiario['regimen'];
  $seguridad = $f_beneficiario['seguridad'];
  $ingreso_bruto_ac=$f_beneficiario['ingreso_bruto_ac'];



     $ssql = "SELECT * FROM iva where id_iva='$iva_situacion'";
     if (!($r_iva= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de cuenta";
      echo $cuerpo1;
      //.....................................................................
    } 
	
	$f_iva= mysql_fetch_array ($r_iva);
	$iva_situacion_n=$f_iva['nombre']; 
	
$ssql = "SELECT * FROM ganancias where id_ganancia='$ganancia'  order by nombre";
     if (!($r_ganancia= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }      
    $f_ganancia= mysql_fetch_array ($r_ganancia);
	$ganancia=$f_ganancia['nombre']; 	  

  $ssql = "SELECT * FROM ingreso_bruto  where id_ingreso='$ingreso' order by nombre ";
     if (!($r_ingreso= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	 $f_ingreso= mysql_fetch_array ($r_ingreso);
	 $ingreso=$f_ingreso['nombre']; 	  
	
	$ssql = "SELECT * FROM regimen where id_regimen='$regimen' order by nombre ";
     if (!($r_regimen= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }   
	
	 $f_regimen= mysql_fetch_array ($r_regimen);
	 $regimen=$f_regimen['nombre']; 	  
	

	
	$ssql = "SELECT * FROM seguridad_social where id_seguridad='$seguridad'  order by nombre ";
     if (!($r_seguridad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }          
     $f_seguridad= mysql_fetch_array ($r_seguridad);
	 $seguridad=$f_seguridad['nombre']; 	  
     
   
	
///////////////////////////////////////////////////////////////////////////////////////

    
$ssql="SELECT  DISTINCT orden_pago, orden_pago.total FROM `orden_pago`
		WHERE (
		(
		orden_pago.`cuit` ='$cuitl'
		)
        AND (
		`orden_pago`.`fecha` >= '$fechaant'
		)
		AND (
		`orden_pago`.`fecha` <= '$fechahoy'
		)
		
		
)";


 if (!($r_tn= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar total retencion";
      echo $cuerpo1;
      //.....................................................................
    }          

$ssql="SELECT DISTINCT orden_pago,orden_pago.importe FROM `orden_pago`
		WHERE (
		(
		orden_pago.`cuit` ='$cuitl'
		)
        AND (
		`orden_pago`.`fecha` >= '$fechaant'
		)
		AND (
		`orden_pago`.`fecha` <= '$fechahoy'
		)
		
		
)";


 if (!($r_tb= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar total retencion1";
      echo $cuerpo1;
      //.....................................................................
    }        
	
	///////////////////////////
$ssql="SELECT  DISTINCT orden_pago, orden_pago_fp.total FROM `orden_pago_fp`
		WHERE (
		(
		orden_pago_fp.`cuit` ='$cuitl'
		)
        AND (
		`orden_pago_fp`.`fecha` >= '$fechaant'
		)
		AND (
		`orden_pago_fp`.`fecha` <= '$fechahoy'
		)
		
		
)";


 if (!($r_pn= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar total retencion";
      echo $cuerpo1;
      //.....................................................................
    }          

$ssql="SELECT DISTINCT orden_pago,orden_pago_fp.importe FROM `orden_pago_fp`
		WHERE (
		(
		orden_pago_fp.`cuit` ='$cuitl'
		)
        AND (
		`orden_pago_fp`.`fecha` >= '$fechaant'
		)
		AND (
		`orden_pago_fp`.`fecha` <= '$fechahoy'
		)
		
		
)";


 if (!($r_pb= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar total retencion1";
      echo $cuerpo1;
      //.....................................................................
    }          


  

define('FPDF_FONTPATH','font/');
require('../fpdf.php');

//Connect to your database
//Create new pdf file
$pdf=new FPDF();
//$pdf=new PDF_AutoPrint();
$pdf=new FPDF('P','mm','A4');
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
//$pdf->setY(10+5);																											
$pdf->setY(30);
$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);

////ENCABEZADO

$pdf->SetFont('Arial','IB',7);
$pdf->setY(45);
$pdf->cell(0,0,'CONSTANCIA DE CONSULTA AL SISTEMA DE PAGO CENTRALIZADO',0,'B','C',0);

$pdf->SetFont('Arial','IB',7);
$pdf->setY(51);
$pdf->cell(0,0,'MODULO DE IMPUESTOS Y RETENCIONES',0,'B','C',0);
$pdf->SetFont('Arial','B',7);
$pdf->setY(57);
$pdf->cell(0,0,'PERIODO DE CONSULTA :'.$ant.' HASTA :'.$hoy ,0,'B','C',0);
$pdf->SetFont('Arial','IBU',7);
$pdf->setY(63);
$pdf->cell(0,0,'DATOS COMERCIALES',0,'B','L',0);


$y_axis_initial = 69;


$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',6);
$pdf->SetY($y_axis_initial);
$pdf->SetX(25);
$pdf->Cell(10,7,'Nº CUIL | CUIT : ',0,0,'L',1);
$pdf->SetX(50);
$pdf->Cell(10,7,$cuitl,0,0,'L',1);
$i = 69;
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(10,7,'DENOMINACION :',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(50);
if ($razon_social=='')
    {
		$pdf->Cell(10,7,$ape.',  '.$nom,0,0,'L',1);
	}
else 
    {
		$pdf->Cell(10,7,$razon_social,0,0,'L',1);
	}
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(10,7,'SIT. FRENTE IVA :',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(10,7,$iva_situacion_n,0,0,'L',1);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(10,7,'GANANCIAS :',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(10,7,$ganancia,0,0,'L',1);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(10,7,'INGRESOS BRUTOS :',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(10,7,$ingreso,0,0,'L',1);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(10,7,'REG. DE CONVENIO :',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(10,7,$regimen,0,0,'L',1);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(10,7,'SEG. SOCIAL :',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(10,7,$seguridad,0,0,'L',1);



//Set Row Height
$row_height = 7;



$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',7);
$pdf->SetY($i=$i+15);
$pdf->SetX(25);
$pdf->Cell(70,7,'DENOMINACION',1,0,'C',1);
$pdf->Cell(30,7,'CODIGO',1,0,'C',1);
$pdf->Cell(0,7,'IMPORTE',1,0,'C',1);

$sumret=0;
$bruto=0;
$liquido=0;

$dd_tb=0;
while ($f_codigo= mysql_fetch_array ($r_codigo))
   {
	   $sumcod=0;
	   	$codigo=$f_codigo['codigo'];
		$dd_nombre=$f_codigo['nombre'];
	  
	   $ssql="SELECT DISTINCT `orden_pago`.`orden_pago` , `dd_retenciones`.`dd_codigo` , `dd_retenciones`.`importe` as impret , `dd_retenciones`.`dd_nombre`
		FROM `dd_retenciones` , `orden_pago`
		WHERE (
		`orden_pago`.`cuit` = dd_retenciones.dd_cuit
		)
		AND (
		`dd_retenciones`.`dd_cuit` ='$cuitl'
		)
		AND orden_pago.orden_pago = dd_retenciones.orden
		AND (
		`orden_pago`.`fecha` >= '$fechaant'
		)
		AND (
		`orden_pago`.`fecha` <= '$fechahoy'
		)
		AND orden_pago.ejercicio <= '2014'
		AND (orden_pago.ejercicio = dd_retenciones.ejercicio)
	    AND (`dd_retenciones`.`dd_codigo`='$codigo')";

		 if (!($r_dd= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar deduccion";
			  echo $cuerpo1;
			  //.....................................................................
			}        
	
	   $can=mysql_num_rows($r_dd);
	   while ($f_dd= mysql_fetch_array ($r_dd))
	       {
			   
			 $codigoa=$codigo;
			 $importe=$f_dd['impret'];
			// $bruto=$f_dd['impbruto'];
			 $sumcod=$sumcod+$importe;
			// $sumbruto=$sumbruto + $bruto;
			 
		   }
		 
		$ssql="SELECT DISTINCT `orden_pago_fp`.`orden_pago` , `dd_retenciones`.`dd_codigo` , `dd_retenciones`.`importe` as impret , `dd_retenciones`.`dd_nombre`
		FROM `dd_retenciones` , `orden_pago_fp`
		WHERE (
		`orden_pago_fp`.`cuit` = dd_retenciones.dd_cuit
		)
		AND (
		`dd_retenciones`.`dd_cuit` ='$cuitl'
		)
		AND orden_pago_fp.orden_pago = dd_retenciones.orden
		AND (
		`orden_pago_fp`.`fecha` >= '$fechaant'
		)
		AND (
		`orden_pago_fp`.`fecha` <= '$fechahoy'
		)
		AND orden_pago_fp.ejercicio <= '2014'
		AND (orden_pago_fp.ejercicio = dd_retenciones.ejercicio)
	    AND (`dd_retenciones`.`dd_codigo`='$codigo')";

		 if (!($r_dd_fp= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar deduccion";
			  echo $cuerpo1;
			  //.....................................................................
			}        
	
	   $can_fp=mysql_num_rows($r_dd_fp);
	   while ($f_dd_fp= mysql_fetch_array ($r_dd_fp))
	       {
			   
			 $codigoa=$codigo;
			 $importe=$f_dd_fp['impret'];
			// $bruto=$f_dd['impbruto'];
			 $sumcod=$sumcod+$importe;
			// $sumbruto=$sumbruto + $bruto;
			 
		   }
		   
		   
		 
		if(($can>0) or ($can_fp >0))
		  {
			  
	   
           $pdf->SetY($i=$i+6);
		   $pdf->SetX(25);
           $pdf->Cell(70,7,$dd_nombre,1,0,'L',1);
           $pdf->Cell(30,7,$codigo,1,0,'C',1);
           $pdf->Cell(0,7,$sumcod,1,0,'R',1);

            $y_axis = $y_axis + $row_height;
 
          }


    $sumret=$sumret+$sumcod;


   }
   
   while ($f_codigo= mysql_fetch_array ($r_e_codigo))
   {
	   $sumcod=0;
	   	$codigo=$f_codigo['codigo'];
		$dd_nombre=$f_codigo['nombre'];
	  
	   $ssql="SELECT DISTINCT `orden_pago`.`orden_pago` , `dd_retenciones`.`dd_codigo` , `dd_retenciones`.`importe` as impret , `dd_retenciones`.`dd_nombre`
		FROM `dd_retenciones` , `orden_pago`
		WHERE (
		`orden_pago`.`cuit` = dd_retenciones.dd_cuit
		)
		AND (
		`dd_retenciones`.`dd_cuit` ='$cuitl'
		)
		AND orden_pago.orden_pago = dd_retenciones.orden
		AND (
		`orden_pago`.`fecha` >= '$fechaant'
		)
		AND (
		`orden_pago`.`fecha` <= '$fechahoy'
		)
		AND orden_pago.ejercicio > '2014'
		AND (orden_pago.ejercicio = dd_retenciones.ejercicio)
	    AND (`dd_retenciones`.`dd_codigo`='$codigo')";

		 if (!($r_dd= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar deduccion";
			  echo $cuerpo1;
			  //.....................................................................
			}        
	
	   $can=mysql_num_rows($r_dd);
	   while ($f_dd= mysql_fetch_array ($r_dd))
	       {
			   
			 $codigoa=$codigo;
			 $importe=$f_dd['impret'];
			// $bruto=$f_dd['impbruto'];
			 $sumcod=$sumcod+$importe;
			// $sumbruto=$sumbruto + $bruto;
			 
		   }
		 
		$ssql="SELECT DISTINCT `orden_pago_fp`.`orden_pago` , `dd_retenciones`.`dd_codigo` , `dd_retenciones`.`importe` as impret , `dd_retenciones`.`dd_nombre`
		FROM `dd_retenciones` , `orden_pago_fp`
		WHERE (
		`orden_pago_fp`.`cuit` = dd_retenciones.dd_cuit
		)
		AND (
		`dd_retenciones`.`dd_cuit` ='$cuitl'
		)
		AND orden_pago_fp.orden_pago = dd_retenciones.orden
		AND (
		`orden_pago_fp`.`fecha` >= '$fechaant'
		)
		AND (
		`orden_pago_fp`.`fecha` <= '$fechahoy'
		)
		AND orden_pago_fp.ejercicio > '2014'
		AND (orden_pago_fp.ejercicio = dd_retenciones.ejercicio)
	    AND (`dd_retenciones`.`dd_codigo`='$codigo')";

		 if (!($r_dd_fp= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar deduccion";
			  echo $cuerpo1;
			  //.....................................................................
			}        
	
	   $can_fp=mysql_num_rows($r_dd_fp);
	   while ($f_dd_fp= mysql_fetch_array ($r_dd_fp))
	       {
			   
			 $codigoa=$codigo;
			 $importe=$f_dd_fp['impret'];
			// $bruto=$f_dd['impbruto'];
			 $sumcod=$sumcod+$importe;
			// $sumbruto=$sumbruto + $bruto;
			 
		   }
		   
		   
		 
		if(($can>0) or ($can_fp >0))
		  {
			  
	   
           $pdf->SetY($i=$i+6);
		   $pdf->SetX(25);
           $pdf->Cell(70,7,$dd_nombre,1,0,'L',1);
           $pdf->Cell(30,7,$codigo,1,0,'C',1);
           $pdf->Cell(0,7,$sumcod,1,0,'R',1);

            $y_axis = $y_axis + $row_height;
 
          }


    $sumret=$sumret+$sumcod;


   }
   
           $pdf->SetFillColor(215,215,215); 
           $pdf->SetY($i=$i+15);
		   $pdf->SetX(25);
           $pdf->Cell(0,3,'',1,0,'C',1);
		   

 $dd_bruto=0;
  while ($f_tt= mysql_fetch_array ($r_tb))
     {
	    $dd_tb=$f_tt['importe'];
	   
	     $dd_bruto=$dd_bruto+$dd_tb;
	 }
 
$dd_neto=0;
  while ($f_tt= mysql_fetch_array ($r_tn))
     {
	    $dd_tn=$f_tt['liquido'];
	   
	     $dd_neto=$dd_neto+$dd_tn;
	 }
	  	
		
 while ($f_pt= mysql_fetch_array ($r_pb))
     {
	    $dd_tb=$f_pt['importe'];
	   
	     $dd_bruto=$dd_bruto+$dd_tb;
	 }
 

  while ($f_pt= mysql_fetch_array ($r_pn))
     {
	    $dd_tn=$f_pt['liquido'];
	   
	     $dd_neto=$dd_neto+$dd_tn;
	 }  
				  
$pdf->SetFillColor(215,215,215);
  
$pdf->SetY($i=$i+10);
$pdf->SetX(25);
$pdf->Cell(0,7,'TOTAL RETENCIONES :',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(95);
$pdf->Cell(0,7,number_format($sumret,2),0,0,'R',1);		
$pdf->SetY($i=$i+10);
$pdf->SetX(25);
$pdf->Cell(0,7,'TOTAL NETO :',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(95);
$pdf->Cell(0,7,number_format($dd_bruto-$sumret,2),0,0,'R',1);		
$pdf->SetY($i=$i+10);
$pdf->SetX(25);
$pdf->Cell(0,7,'TOTAL FACTURADO :',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(95);
$pdf->Cell(0,7,number_format($dd_bruto,2),0,0,'R',1);		


$pdf->SetFillColor(215,215,215);
$pdf->SetY(-60);
$pdf->SetX(25);
$pdf->Cell(40,5,'LIMITE MAXIMO ',0,0,'C',1);
$pdf->Cell(50,5,'LOCACION Y/O PREST. DE SERVICIO ',0,0,'L',1);
$pdf->Cell(50,5,'VTA DE COSAS MUEBLES ',0,0,'L',1);
$pdf->SetY(-55);
$pdf->SetX(25);
$pdf->Cell(40,5,'CATEGORIA :',0,0,'L',1);

$pdf->SetFillColor(256,256,256);

$pdf->Cell(50,5,' I ',1,0,'C',1);

$pdf->Cell(50,5,' L* ',1,0,'C',1);
$pdf->SetFillColor(215,215,215);
$pdf->SetY(-50);
$pdf->SetX(25);
$pdf->Cell(40,5,'ING. BRUTO ANUAL :',0,0,'L',1);
$pdf->SetFillColor(256,256,256);

$pdf->Cell(50,5,'$400.000 ',1,0,'C',1);
$pdf->Cell(50,5,'$600.000 ',1,0,'C',1);



$pdf->SetFillColor(256,256,256);
$pdf->SetY(-25);
$pdf->SetX(130);
$pdf->Cell(70,3,'-----------------------------------------------',0,0,'L',1);
$pdf->SetY(-22);
$pdf->SetX(130);
$pdf->Cell(50,3,'Firma Director de Administracion',0,0,'L',1);	   

// $dd_tb=$dd_tb +$sumbruto;
 
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


