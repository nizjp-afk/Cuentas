<?php

  //  error_reporting (E_ERROR); 
   header("Content-Type: plain/text");
header("Content-Disposition: Attachment; filename=sicore.txt");
header("Pragma: no-cache");
	
    /*include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    //include('../conexion/extras.php');  	
	*/
	
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
	
	$fechaant = $_POST['firstinput'];
	$fechahoy = $_POST['secondinput']; 
	
	
 //  and `inhi`!='Cta Cerrada'
    $aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
  
 //   include('../incluir_siempre.php');
  
$sql="SELECT s.fecha_io AS fecha_inicio, s.orden, p.importe AS monto, r.codigo, s.neto AS base_imponible, p.fecha AS fecha_pago, s.monto AS retnecion, p.cuit
FROM orden_pago_fp AS p, sicore AS s, anexorg830 AS r
WHERE p.orden_pago = s.orden
AND p.ejercicio = s.ejercicio
AND p.saf = s.saf
AND r.id_rg = s.regimen830_id
AND s.monto >0
AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
ORDER BY p.fecha";
if (!($res= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 
	
$sql="SELECT s.fecha_io AS fecha_inicio, s.orden, p.importe AS monto, r.codigo, s.neto AS base_imponible, p.fecha AS fecha_pago, s.monto AS retnecion, p.cuit
FROM orden_pago AS p, sicore AS s, anexorg830 AS r
WHERE p.orden_pago = s.orden
AND p.ejercicio = s.ejercicio
AND p.saf = s.saf
AND r.id_rg = s.regimen830_id
AND s.monto > 19
AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
ORDER BY p.fecha";
if (!($res_ft= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 	
	

//numero de columnas
$columnas = mysql_num_fields($res);
/*

$sql1="SELECT `cbu_cta` ,`cuitl` 
FROM `beneficiarios_aprobados` where id_beneficiario !='675' and estado != 'B'  order by id_beneficiario";
if (!($secion= mysql_query($sql1, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 
*/




//agrego los nombres de las tablas


//agrego contenido a los datos
while($datos = mysql_fetch_assoc($res))
    {
 
	
	for($j=0; $j<$columnas; $j++)
	{
	   if ($j==0)
	      {
			   $fecha_i=explode('-',$datos[mysql_field_name($res,$j)]);
			   $fecha_io=$fecha_i[2].'/'.$fecha_i[1].'/'.$fecha_i[0];
			 echo '06'.$fecha_io ;
		  }
	   elseif ($j==1)
	     {
			
			echo str_pad($datos[mysql_field_name($res,$j)],12,'0',STR_PAD_LEFT);
			 
		 }
		elseif ($j==2)
	     {
			$monto=str_pad($datos[mysql_field_name($res,$j)],20,' ',STR_PAD_LEFT);
			echo str_pad($monto,12,' ',STR_PAD_LEFT);
			 
		 } 
		 elseif ($j==3)
	     {
			
			echo '217'.str_pad($datos[mysql_field_name($res,$j)],3,'0',STR_PAD_LEFT).'1';
			 
		 } 
		elseif ($j==4)
	     {
			$neto=str_pad($datos[mysql_field_name($res,$j)],14,' ',STR_PAD_LEFT);
			
			 
		 } 
		elseif ($j==5)
	      {
			   $fecha_p=explode('-',$datos[mysql_field_name($res,$j)]);
			   $fecha_po=$fecha_p[2].'/'.$fecha_p[1].'/'.$fecha_p[0];
			 echo $neto.$fecha_po.'010';
		  }
		elseif ($j==6)
	     {
			$var='0.00';
			echo str_pad($datos[mysql_field_name($res,$j)],14,' ',STR_PAD_LEFT).str_pad($var,6,' ',STR_PAD_LEFT);
			 
		 }  
		  elseif ($j==7)
	     {
			$var1='80';
			$var2='00000000000000';
			$cuit=$datos[mysql_field_name($res,$j)];
			echo str_pad($var1,12,' ',STR_PAD_LEFT).$cuit.str_pad($var2,23,' ',STR_PAD_LEFT);
			   
		 }  
		  
	}

	echo chr(13).chr(10);

	}

$columnas = mysql_num_fields($res_ft);
/*

$sql1="SELECT `cbu_cta` ,`cuitl` 
FROM `beneficiarios_aprobados` where id_beneficiario !='675' and estado != 'B'  order by id_beneficiario";
if (!($secion= mysql_query($sql1, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 
*/




//agrego los nombres de las tablas


//agrego contenido a los datos
while($datos = mysql_fetch_assoc($res_ft))
    {
 
	
	for($j=0; $j<$columnas; $j++)
	{
	   if ($j==0)
	      {
			   $fecha_i=explode('-',$datos[mysql_field_name($res,$j)]);
			   $fecha_io=$fecha_i[2].'/'.$fecha_i[1].'/'.$fecha_i[0];
			 echo '06'.$fecha_io ;
		  }
	   elseif ($j==1)
	     {
			
			echo str_pad($datos[mysql_field_name($res,$j)],12,'0',STR_PAD_LEFT);
			 
		 }
		elseif ($j==2)
	     {
			$monto=str_pad($datos[mysql_field_name($res,$j)],20,' ',STR_PAD_LEFT);
			echo str_pad($monto,12,' ',STR_PAD_LEFT);
			 
		 } 
		 elseif ($j==3)
	     {
			
			echo '217'.str_pad($datos[mysql_field_name($res,$j)],3,'0',STR_PAD_LEFT).'1';
			 
		 } 
		elseif ($j==4)
	     {
			$neto=str_pad($datos[mysql_field_name($res,$j)],14,' ',STR_PAD_LEFT);
			
			 
		 } 
		elseif ($j==5)
	      {
			   $fecha_p=explode('-',$datos[mysql_field_name($res,$j)]);
			   $fecha_po=$fecha_p[2].'/'.$fecha_p[1].'/'.$fecha_p[0];
			 echo $neto.$fecha_po.'010';
		  }
		elseif ($j==6)
	     {
			$var='0.00';
			echo str_pad($datos[mysql_field_name($res,$j)],14,' ',STR_PAD_LEFT).str_pad($var,6,' ',STR_PAD_LEFT);
			 
		 }  
		  elseif ($j==7)
	     {
			$var1='80';
			$var2='00000000000000';
			$cuit=$datos[mysql_field_name($res,$j)];
			echo str_pad($var1,12,' ',STR_PAD_LEFT).$cuit.str_pad($var2,23,' ',STR_PAD_LEFT);
			   
		 }  
		  
	}

	echo chr(13).chr(10);

	}


?>