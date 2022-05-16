<?php
 error_reporting ( E_ERROR );
   //conexion1159954037
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
   // include('conexion/extras.php');
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	$saf = $_POST['saf'];
	
	//$fecha_cons=$_GET['consul'];	
	
	//$max_fecha='2011-11-17';
	
	//$saf='301';
   $fechaant = $_POST['firstinput'];
   $fechahoy = $_POST['secondinput'];   
   $val='0'; 	  
   $max=20;
   $c_dias=1;
   $v=0;
   $f=strftime("%Y-%m-%d");
   $dia = date("d/m/Y");
   $hora =date("H:i");
  //// ver 
   $fechaant_t = date("d-m-Y", strtotime("$fechaant")); 
   $fechahoy_t = date("d-m-Y", strtotime("$fechahoy"));    
   $d_i=$_POST['diah']-1;
   
  $f_s_i= date("d-m-Y", strtotime("$fechaant -$c_dias day"));  
  
  
  
  ////// retenciones por banco

 $ssql = "SELECT sum( retenciones ) as rioja_ret
	         FROM escritural 
			 where fecha >='$fechaant' 
			 and fecha <= '$fechahoy'
			 AND cod_proceso = '3'
			 AND `bco_pagador`='10'
            ORDER BY `esc_cuenta` ASC ,fecha asc, `cod_proceso` ASC ";
     if (!($r_ret_rioja= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	$f_ret_rioja=mysql_fetch_array($r_ret_rioja);
	$rioja_ret=$f_ret_rioja['rioja_ret'];
  
    $ssql = "SELECT sum( retenciones ) as nacion_ret
	         FROM escritural 
			 where fecha >='$fechaant' 
			 and fecha <= '$fechahoy'
			 AND cod_proceso = '3'
			 AND `bco_pagador`='32'
            ORDER BY `esc_cuenta` ASC ,fecha asc, `cod_proceso` ASC ";
     if (!($r_ret_nacion= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	$f_ret_nacion=mysql_fetch_array($r_ret_nacion);
	$nacion_ret=$f_ret_nacion['nacion_ret'];
  
  
    
//echo "paso";exit; 		
define('FPDF_FONTPATH','font/');
require('../fpdf.php');

//Connect to your database
//Create new pdf file
$pdf=new FPDF('L','mm','A4');
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
/*$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
$pdf->SetY($y_axis_initial+5);
$pdf->cell(0,0,'HORA: '.$hora,0,'B','R',0);
$pdf->SetY($y_axis_initial+10);
$pdf->SetFont('Arial','B',8);*/
//$pdf->cell(0,0,'Nº Autorizacion: '.$nro,0,'B','R',0);


//set initial y axis position per page
$y_axis_initial = 20;
$pdf->SetY($y_axis_initial);
$pdf->SetFont('Arial','B',12);
$pdf->SetX(10);
$pdf->cell(0,0,'Resumen Consolidado - Cuentas Escriturales',0,'B','C',0);
$pdf->SetX(10);
//$pdf->Cell(0,4,'SOLICITUD DE PAGO SERVICIO DE ADMINISTRACION FINANCIERA '.$saf,'0',0,'L',0);

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',10);
$i=23;
$pdf->SetY($i);
$pdf->SetX(10);
$pdf->Cell(0,4,'PERIODO',0,0,'L',0);
$pdf->SetX(40);
$pdf->Cell(0,4,'DESDE',0,0,'L',0);
$pdf->SetX(60);
$pdf->Cell(0,4,'HASTA',0,0,'L',0);





$pdf->SetY($i=$i+5);
$pdf->SetX(35);

	  $pdf->Cell(0,4,$fechaant_t,0,0,'L',0);
	  $pdf->SetX(58);
	  $pdf->Cell(0,4,$fechahoy_t,0,0,'L',0);
  
	
$pdf->SetY($i=$i+7);

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',6);
$pdf->SetX(3);
//$pdf->Cell(10,6,'Saf',1,0,'C',1);
$pdf->Cell(25,6,'',0,0,'C',1);
$pdf->Cell(10,6,'',0,0,'C',1);
$pdf->Cell(30,6,'',0,0,'C',1);
$pdf->SetFillColor(215,215,215);
$pdf->Cell(56,6,'BANCO NACION',1,0,'C',1);
$pdf->Cell(56,6,'BANCO RIOJA',1,0,'C',1);
$pdf->SetFillColor(256,256,256);

$pdf->SetY($i=$i+6);

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',6);
$pdf->SetFillColor(215,215,215);
$pdf->SetX(3);
//$pdf->Cell(10,6,'Saf',1,0,'C',1);
$pdf->Cell(30,6,'Cuentas',1,0,'C',1);
$pdf->Cell(10,6,'SAF',1,0,'C',1);
$pdf->Cell(30,6,'Saldo '.$f_s_i,1,0,'C',1);
$pdf->Cell(28,6,'Ingreso ',1,0,'C',1);
$pdf->Cell(28,6,'Ingreso  TGP',1,0,'C',1);
$pdf->Cell(28,6,'Ingreso ',1,0,'C',1);
$pdf->Cell(28,6,'Ingreso TGP',1,0,'C',1);
$pdf->Cell(28,6,'Egreso Bco Nacion ',1,0,'C',1);
$pdf->Cell(28,6,'Egreso Bco Rioja',1,0,'C',1);
$pdf->Cell(27,6,'Retenciones',1,0,'C',1);
$pdf->Cell(30,6,'Saldo '.$fechahoy_t,1,0,'C',1);
$pdf->SetFillColor(256,256,256);
	 $ssql = "SELECT *  FROM `saf_escritural` where estado='A' order by saf,escritural";
     if (!($r_saf= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
	}
 while ($f_saf=mysql_fetch_array($r_saf))
     {
	    $escritural =trim($f_saf['ESCRITURAL']);
		
	 $ssql = "SELECT * FROM escritural where esc_cuenta='$escritural' 
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
   $tot_saldo=0;

				 $credito_nacion=0;
				 $credito_nacion_tgp=0;
				  
				 $credito_rioja=0;
				 $credito_rioja_tgp=0;
				 
				 $credito_nacion_d=0;
				 $credito_nacion_tgp_d=0;
				  
				 $credito_rioja_d=0;
				 $credito_rioja_tgp_d=0;
				  
				$t_debito=0;
				  
				 $retenciones=0;
				 $total_saldo_dia=0;
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
   $Ejercicio =trim($f_ope['esc_cuenta']);
   $den_saf =$f_ope['saf'];
   
 ///////////////////////////PROCESO 2////////////////////////////////  
   
////suma credito proceso 2 banco nacion
    
    $ssql = "SELECT sum( credito ) as nacion_credito
	         FROM escritural 
			 where fecha >='$fechaant' 
			 and fecha <= '$fechahoy'
			 and esc_cuenta='$Ejercicio'
			 AND cod_proceso = '2'
             AND `nro_bco` = '325'
			  AND `num_cuenta`!='3250045653'
			 ORDER BY `esc_cuenta` ASC ,fecha asc, `cod_proceso` ASC ";
     if (!($r_cre_nacion= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
	$f_cre_nacion=mysql_fetch_array($r_cre_nacion);
	$credito_nacion=$f_cre_nacion['nacion_credito'];
	
////suma credito proceso 2 banco nacion tgp
		
 $ssql = "SELECT sum( credito ) as nacion_credito_tgp
              FROM escritural
              where  fecha >='$fechaant' 
			  and fecha <= '$fechahoy'
			  and esc_cuenta='$Ejercicio'
              AND cod_proceso = '2'
              AND `num_cuenta`='3250045653'
              ORDER BY `esc_cuenta` ASC , fecha ASC , `cod_proceso` ASC";
 
 if (!($r_cre_nacion_tgp= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
$f_cre_nacion_tgp=mysql_fetch_array($r_cre_nacion_tgp);
$credito_nacion_tgp=$f_cre_nacion_tgp['nacion_credito_tgp'];

	

////suma credito proceso 2	banco rioja
	 $ssql = "SELECT sum( credito ) as rioja_credito
	         FROM escritural 
			 where  fecha >='$fechaant' 
			 and fecha <= '$fechahoy'
			 and esc_cuenta='$Ejercicio'
			 AND cod_proceso = '2'
             AND `nro_bco` = '101'
			 AND `num_cuenta`!='101006006'
			 ORDER BY `esc_cuenta` ASC ,fecha asc, `cod_proceso` ASC ";
     if (!($r_cre_rioja= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	$f_cre_rioja=mysql_fetch_array($r_cre_rioja);
	$credito_rioja=$f_cre_rioja['rioja_credito'];
	
////suma credito proceso 2	 banco rioja tgp
	
	 $ssql = "SELECT sum( credito ) as rioja_credito_tgp
              FROM escritural
              where fecha >='$fechaant' 
			  and fecha <= '$fechahoy'
			  and esc_cuenta='$Ejercicio'
              AND cod_proceso = '2'
              AND `num_cuenta`='101006006'
              ORDER BY `esc_cuenta` ASC , fecha ASC , `cod_proceso` ASC";
 
 if (!($r_cre_rioja_tgp= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
$f_cre_rioja_tgp=mysql_fetch_array($r_cre_rioja_tgp);
$credito_rioja_tgp=$f_cre_rioja_tgp['rioja_credito_tgp'];

///////////////////////////////////////////////////////////////////////////////


//////////SUMA DE DEBITO EN PROCESO 2 EL CUAL ES RESTADO DEL CREDITO///

/////////////////////CORRESPONDE A DEVOLUCIONES////////////////////////

   
////suma credito proceso 2 banco nacion
    
    $ssql = "SELECT sum( debito ) as nacion_credito_d
	         FROM escritural 
			 where fecha >='$fechaant' 
			 and fecha <= '$fechahoy'
			 and esc_cuenta='$Ejercicio'
			 AND cod_proceso = '2'
             AND `nro_bco` = '325'
			  AND `num_cuenta`!='3250045653'
			 ORDER BY `esc_cuenta` ASC ,fecha asc, `cod_proceso` ASC ";
     if (!($r_cre_nacion_d= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
	$f_cre_nacion_d=mysql_fetch_array($r_cre_nacion_d);
	$credito_nacion_d=$f_cre_nacion_d['nacion_credito_d'];
	
////suma credito proceso 2 banco nacion tgp
		
 $ssql = "SELECT sum( debito ) as nacion_credito_tgp_d
              FROM escritural
              where fecha >='$fechaant' 
			  and fecha <= '$fechahoy'
			  and esc_cuenta='$Ejercicio'
              AND cod_proceso = '2'
              AND `num_cuenta`='3250045653'
              ORDER BY `esc_cuenta` ASC , fecha ASC , `cod_proceso` ASC";
 
 if (!($r_cre_nacion_tgp_d= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
$f_cre_nacion_tgp_d=mysql_fetch_array($r_cre_nacion_tgp_d);
$credito_nacion_tgp_d=$f_cre_nacion_tgp_d['nacion_credito_tgp_d'];

	

////suma credito proceso 2	banco rioja
	 $ssql = "SELECT sum( debito ) as rioja_credito_d
	         FROM escritural 
			 where  fecha >='$fechaant' 
			 and fecha <= '$fechahoy'
			 and esc_cuenta='$Ejercicio'
			 AND cod_proceso = '2'
             AND `nro_bco` = '101'
			 AND `num_cuenta`!='101006006'
			 ORDER BY `esc_cuenta` ASC ,fecha asc, `cod_proceso` ASC ";
     if (!($r_cre_rioja_d= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	$f_cre_rioja_d=mysql_fetch_array($r_cre_rioja_d);
	$credito_rioja_d=$f_cre_rioja_d['rioja_credito_d'];
	
////suma credito proceso 2	 banco rioja tgp
	
	 $ssql = "SELECT sum( debito ) as rioja_credito_tgp_d
              FROM escritural
              where fecha >='$fechaant' 
			  and fecha <= '$fechahoy'
			  and esc_cuenta='$Ejercicio'
              AND cod_proceso = '2'
              AND `num_cuenta`='101006006'
              ORDER BY `esc_cuenta` ASC , fecha ASC , `cod_proceso` ASC";
 
 if (!($r_cre_rioja_tgp_d= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
$f_cre_rioja_tgp_d=mysql_fetch_array($r_cre_rioja_tgp_d);
$credito_rioja_tgp_d=$f_cre_rioja_tgp_d['rioja_credito_tgp_d'];

///////////////////////////////////////////////////////////////////////////////




////////////////////SUMA DEBITO PROCESO3 BANCO RIOJA////////////////////


	 $ssql = "SELECT sum( debito ) as rioja_debito
	         FROM escritural 
			 where fecha >='$fechaant' 
			 and fecha <= '$fechahoy'
			 and esc_cuenta='$Ejercicio'
			 AND cod_proceso = '3'
			 AND `bco_pagador`='10'
            ORDER BY `esc_cuenta` ASC ,fecha asc, `cod_proceso` ASC ";
     if (!($r_debito_rioja= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	$f_debito_rioja=mysql_fetch_array($r_debito_rioja);
	$debito_rioja=$f_debito_rioja['rioja_debito'];
  
    $t_debito_rioja=$debito_rioja+$credito_rioja_d+$credito_rioja_tgp_d;


////////////////////SUMA DEBITO PROCESO3 BANCO NACION////////////////////


	 $ssql = "SELECT sum( debito ) as nacion_debito
	         FROM escritural 
			 where fecha >='$fechaant' 
			 and fecha <= '$fechahoy'
			 and esc_cuenta='$Ejercicio'
			 AND cod_proceso = '3'
			 AND `bco_pagador`='32'
            ORDER BY `esc_cuenta` ASC ,fecha asc, `cod_proceso` ASC ";
     if (!($r_debito_nacion= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	$f_debito_nacion=mysql_fetch_array($r_debito_nacion);
	$debito_nacion=$f_debito_nacion['nacion_debito'];
  
    $t_debito_nacion=$debito_nacion+$credito_nacion_d+$credito_nacion_tgp_d;


///////////////////////////////////////////////////////////////////////////

$ssql = "SELECT sum( retenciones ) as retenciones
              FROM escritural
              where  fecha >='$fechaant' 
			  and fecha <= '$fechahoy'
			  and esc_cuenta='$Ejercicio'
             ORDER BY `esc_cuenta` ASC , fecha ASC , `cod_proceso` ASC";
 
 if (!($r_retenciones= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
$f_retenciones=mysql_fetch_array($r_retenciones);
$retenciones=$f_retenciones['retenciones'];
	

		
	$ssql = "SELECT sum(`debito`) as debito, sum(`credito`) as credito,sum(`retenciones`) as retenciones  FROM escritural 
	          where  fecha <'$fechaant'
			  and esc_cuenta='$Ejercicio'
			 ";
     if (!($r_trans= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
	
	$f_trans=mysql_fetch_array($r_trans);
	
	 $t_debito_t =$f_trans['debito'];
	 $t_credito =$f_trans['credito'];
	  $t_retenciones =$f_trans['retenciones'];
	 $transporte_s=$t_credito-$t_debito_t- $t_retenciones ;
	// $transporte_s=$t_credito-$t_debito;
	 $tot_saldo=$transporte_s;
	 $tot_gral_saldo=0;
	//$tot_gral_saldo=0;
	

$total_saldo_dia=$tot_saldo+$credito_nacion+$credito_nacion_tgp+$credito_rioja+$credito_rioja_tgp-$retenciones-$t_debito_nacion-$t_debito_rioja;
///////////////////////////////////////////////////////////////////////////////////////


   



$aux=='';
//$y_axis=54;
$row_height = 7;
$InterLigne = 4;
  if ($max==$cp)
    {$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Hora Impresion: '.$hora,0,0,'L');


$pdf->Cell(0,10,'Fecha Impresion: '.$dia,0,0,'R');
$pdf->SetY(-10);
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');


$pdf->AliasNbPages();

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
		//$pdf->cell(0,0,'Nº Autorizacion: '.$nroaux,0,'B','R',0);

		
		//set initial y axis position per page
						$y_axis_initial = 20;
				$pdf->SetY($y_axis_initial);
				$pdf->SetFont('Arial','B',12);
				$pdf->SetX(10);
				$pdf->cell(0,0,'Resumen Consolidado - Cuentas Escriturales',0,'B','C',0);
$pdf->SetX(10);
//$pdf->Cell(0,4,'SOLICITUD DE PAGO SERVICIO DE ADMINISTRACION FINANCIERA '.$saf,'0',0,'L',0);

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',10);
$i=23;
$pdf->SetY($i);
$pdf->SetX(10);
$pdf->Cell(0,4,'PERIODO',0,0,'L',0);
$pdf->SetX(40);
$pdf->Cell(0,4,'DESDE',0,0,'L',0);
$pdf->SetX(60);
$pdf->Cell(0,4,'HASTA',0,0,'L',0);





$pdf->SetY($i=$i+5);
$pdf->SetX(35);

	  $pdf->Cell(0,4,$fechaant_t,0,0,'L',0);
	  $pdf->SetX(58);
	  $pdf->Cell(0,4,$fechahoy_t,0,0,'L',0);
  
	
$pdf->SetY($i=$i+7);

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',6);
$pdf->SetX(3);
//$pdf->Cell(10,6,'Saf',1,0,'C',1);
$pdf->Cell(25,6,'',0,0,'C',1);
$pdf->Cell(10,6,'',0,0,'C',1);
$pdf->Cell(30,6,'',0,0,'C',1);
$pdf->SetFillColor(215,215,215);
$pdf->Cell(56,6,'BANCO NACION',1,0,'C',1);
$pdf->Cell(56,6,'BANCO RIOJA',1,0,'C',1);
$pdf->SetFillColor(256,256,256);

$pdf->SetY($i=$i+6);

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',6);
$pdf->SetFillColor(215,215,215);
$pdf->SetX(3);
//$pdf->Cell(10,6,'Saf',1,0,'C',1);
$pdf->Cell(30,6,'Cuentas',1,0,'C',1);
$pdf->Cell(10,6,'SAF',1,0,'C',1);
$pdf->Cell(30,6,'Saldo '.$f_s_i,1,0,'C',1);
$pdf->Cell(28,6,'Ingreso ',1,0,'C',1);
$pdf->Cell(28,6,'Ingreso  TGP',1,0,'C',1);
$pdf->Cell(28,6,'Ingreso ',1,0,'C',1);
$pdf->Cell(28,6,'Ingreso TGP',1,0,'C',1);
$pdf->Cell(28,6,'Egreso Bco Nacion ',1,0,'C',1);
$pdf->Cell(28,6,'Egreso Bco Rioja',1,0,'C',1);
$pdf->Cell(27,6,'Retenciones',1,0,'C',1);
$pdf->Cell(30,6,'Saldo '.$fechahoy_t,1,0,'C',1);
	$pdf->SetFillColor(256,256,256);

		$cp=0;
		//$y_axis=54;
		$row_height = 7;
		$InterLigne = 4;
	}
  
  //If the current row is the last one, create new page and print column title
   
     	         $pdf->SetFont('courier','',8);
	             
				 $pdf->SetY($i=$i+7);
                 $pdf->SetX(3);

		          
				  $pdf->Cell(30,6,$Ejercicio,1,0,'L',1);  
                 //  $pdf->SetFont('courier','',6);
				  $pdf->Cell(10,6,$den_saf,1,0,'C',1);
				   $pdf->SetFont('courier','',8);
				  $pdf->Cell(30,6,number_format($tot_saldo,2),1,0,'R',1);
				  
				  
				  $pdf->Cell(28,6,number_format($credito_nacion,2),1,0,'R',1);
				  $pdf->Cell(28,6,number_format($credito_nacion_tgp,2),1,0,'R',1);
				  
				  $pdf->Cell(28,6,number_format($credito_rioja,2),1,0,'R',1);
				  $pdf->Cell(28,6,number_format($credito_rioja_tgp,2),1,0,'R',1);
				   $pdf->Cell(28,6,number_format($t_debito_nacion,2),1,0,'L',1);
				  $pdf->Cell(28,6,number_format($t_debito_rioja,2),1,0,'L',1);
				  
				  $pdf->Cell(27,6,number_format($retenciones,2),1,0,'R',1);
				  $pdf->Cell(30,6,number_format($total_saldo_dia,2),1,0,'R',1);
			
	//$pdf->line(15,$y_axis,205,$y_axis); 
        $cp=$cp+1; 
	    $y_axis = $y_axis + $row_height;
		
		$tot_saldo_inicio=$tot_saldo_inicio +$tot_saldo;
	    
		$total_debito_n=$total_debito_n+$t_debito_nacion;
	    $total_debito_r=$total_debito_r+$t_debito_rioja;
		
		
	    $total_credito_n=$total_credito_n+$credito_nacion;
		$total_credito_ntgp=$total_credito_ntgp+$credito_nacion_tgp;
		
		$total_credito_r=$total_credito_r+$credito_rioja;
		$total_credito_rtgp=$total_credito_rtgp+$credito_rioja_tgp;
			
	    $total_retenciones=$total_retenciones+$retenciones;
	    
		$total_gral_saldo=$total_gral_saldo+$total_saldo_dia;
		 }
  }
 
  $pdf->SetY($i=$i+7);
                 $pdf->SetX(3);
                   $pdf->SetFont('courier','B',8);   
		          $pdf->SetFillColor(215,215,215);
				  $pdf->Cell(25,6,'TOTALES',0,0,'L',1);  
                 //  $pdf->SetFont('courier','',6);
				  $pdf->Cell(10,6,'',0,0,'C',1);
				  
				  $pdf->Cell(30,6,number_format($tot_saldo_inicio,2),0,0,'R',1);
				  
				  
				  $pdf->Cell(28,6,number_format($total_credito_n,2),0,0,'R',1);
				  $pdf->Cell(28,6,number_format($total_credito_ntgp,2),0,0,'R',1);
				  
				  $pdf->Cell(28,6,number_format($total_credito_r,2),0,0,'R',1);
				  $pdf->Cell(28,6,number_format($total_credito_rtgp,2),0,0,'R',1);
				   $pdf->Cell(28,6,number_format($total_debito_n,2),0,0,'L',1);
				  $pdf->Cell(28,6,number_format($total_debito_r,2),0,0,'L',1);
				  
				  $pdf->Cell(27,6,number_format($total_retenciones,2),0,0,'R',1);
				  $pdf->Cell(30,6,number_format($total_gral_saldo,2),0,0,'R',1);  

       $tot_nacion=$total_credito_n+$total_credito_ntgp;
	   $tot_rioja=$total_credito_r+$total_credito_rtgp;
	   
	   

$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Hora Impresion: '.$hora,0,0,'L');


$pdf->Cell(0,10,'Fecha Impresion: '.$dia,0,0,'R');
$pdf->SetY(-10);
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');


$pdf->AliasNbPages();

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
		//$pdf->cell(0,0,'Nº Autorizacion: '.$nroaux,0,'B','R',0);

		
		//set initial y axis position per page
						$y_axis_initial = 20;
				$pdf->SetY($y_axis_initial);
				$pdf->SetFont('Arial','B',12);
				$pdf->SetX(10);
				$pdf->cell(0,0,'Resumen Consolidado - Cuentas Escriturales',0,'B','C',0);
$pdf->SetX(10);
//$pdf->Cell(0,4,'SOLICITUD DE PAGO SERVICIO DE ADMINISTRACION FINANCIERA '.$saf,'0',0,'L',0);

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',10);
$i=23;
$pdf->SetY($i);
$pdf->SetX(10);
$pdf->Cell(0,4,'PERIODO',0,0,'L',0);
$pdf->SetX(40);
$pdf->Cell(0,4,'DESDE',0,0,'L',0);
$pdf->SetX(60);
$pdf->Cell(0,4,'HASTA',0,0,'L',0);





$pdf->SetY($i=$i+5);
$pdf->SetX(35);

	  $pdf->Cell(0,4,$fechaant_t,0,0,'L',0);
	  $pdf->SetX(58);
	  $pdf->Cell(0,4,$fechahoy_t,0,0,'L',0);
  
	
$pdf->SetY($i=$i+10);
$pdf->SetX(30);
$pdf->Cell(0,8,'Saldo al '.$f_s_i,1,0,'L',0);
$pdf->Cell(0,8,number_format($tot_saldo_inicio,2),1,0,'R',0);

$pdf->SetY($i=$i+10);
$pdf->SetX(30);
$pdf->Cell(0,8,'Entidad Bancaria ',0,0,'L',0);
$pdf->SetX(100);
$pdf->Cell(0,8,'Ingresos ',0,0,'L',0);
$pdf->SetX(150);
$pdf->Cell(0,8,'Egresos ',0,0,'L',0);

$pdf->SetX(200);
$pdf->Cell(0,8,'Retenciones ',0,0,'L',0);


$pdf->Cell(0,8,'Saldo ',0,0,'R',0);


$pdf->SetY($i=$i+10);
$pdf->SetX(30);
$pdf->Cell(0,8,'Banco de la Nacion Argentina ',0,0,'L',0);
$pdf->SetX(100);
$pdf->Cell(0,8,number_format($tot_nacion,2),0,0,'L',0);
$pdf->SetX(150);
$pdf->Cell(0,8,number_format($total_debito_n,2),0,0,'L',0);

$pdf->SetX(200);
$pdf->Cell(0,8,number_format($nacion_ret,2),0,0,'L',0);

$saldo_nacion=$tot_nacion-$total_debito_n-$nacion_ret;
$saldo_rioja=$tot_rioja-$total_debito_r-$rioja_ret;

$pdf->Cell(0,8,number_format($saldo_nacion,2),0,0,'R',0);

$pdf->SetY($i=$i+10);
$pdf->SetX(30);
$pdf->Cell(0,8,'Nuevo Banco de la Rioja ',0,0,'L',0);
$pdf->SetX(100);
$pdf->Cell(0,8,number_format($tot_rioja,2),0,0,'L',0);
$pdf->SetX(150);
$pdf->Cell(0,8,number_format($total_debito_r,2),0,0,'L',0);

$pdf->SetX(200);
$pdf->Cell(0,8,number_format($rioja_ret,2),0,0,'L',0);


$pdf->Cell(0,8,number_format($saldo_rioja,2),0,0,'R',0);
//$pdf->Cell(0,8,number_format($tot_saldo_inicio,2),1,0,'R',0);

$total_ingreso=$tot_nacion+$tot_rioja;
$total_egreso=$total_debito_r+$total_debito_n;
$total_ret=$rioja_ret+$nacion_ret;
$total_saldo=$saldo_nacion+$saldo_rioja;

$pdf->SetY($i=$i+7);
$pdf->SetX(30);
$pdf->Cell(0,4,'','T',0,'L',1);

$pdf->SetY($i=$i+4);
$pdf->SetX(100);
$pdf->Cell(0,8,number_format($total_ingreso,2),0,0,'L',0);
$pdf->SetX(150);
$pdf->Cell(0,8,number_format($total_egreso,2),0,0,'L',0);

$pdf->SetX(200);
$pdf->Cell(0,8,number_format($total_ret,2),0,0,'L',0);


$pdf->Cell(0,8,number_format($total_saldo,2),0,0,'R',0);

$total=$tot_saldo_inicio+$total_saldo;
$pdf->SetY($i=$i+10);
$pdf->SetX(30);
$pdf->Cell(0,8,'Saldo al '.$fechahoy_t,1,0,'L',0);
$pdf->Cell(0,8,number_format($total,2),1,0,'R',0);


$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Hora Impresion: '.$hora,0,0,'L');


$pdf->Cell(0,10,'Fecha Impresion: '.$dia,0,0,'R');

$pdf->SetY(-10);
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
$pdf->AliasNbPages();

$pdf->Output();

?>

