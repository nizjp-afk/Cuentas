<?php

   error_reporting (E_ERROR); 
   header("Content-Type: plain/text");
header("Content-Disposition: Attachment; filename=sicoreft.txt");
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
  

	
$sql="SELECT s.fecha_io AS fecha_inicio, s.orden, p.importe AS monto, r.codigo, s.neto AS base_imponible, p.fecha AS fecha_pago,  d.importe AS retnecion, p.cuit
FROM orden_pago AS p, sicore AS s, anexorg830 AS r,dd_retenciones as d,beneficiarios_aprobados as b
WHERE p.orden_pago = s.orden
AND p.ejercicio = s.ejercicio
AND p.saf = s.saf
AND b.sociedad_tipo !='16'
AND p.cuit= b.cuitl
AND r.id_rg = s.regimen830_id
AND s.monto >= '20'
AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
AND p.orden_pago = d.orden
AND p.ejercicio = d.ejercicio
AND p.saf = d.saf
AND d.dd_codigo = '201'
AND s.numero != ''
ORDER BY p.fecha
";
if (!($res_ft= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 	
	



$columnas = mysql_num_fields($res_ft);
$columnas=$columnas-1;


$sql="SELECT s.fecha_io AS fecha_inicio, s.orden, p.importe AS monto, r.codigo, s.neto AS base_imponible, p.fecha AS fecha_pago, d.importe AS retnecion, p.cuit,s.numero
FROM orden_pago_fp AS p, sicore AS s, anexorg830 AS r,dd_retenciones as d,beneficiarios_aprobados as b
WHERE p.orden_pago = s.orden
AND p.ejercicio = s.ejercicio
AND p.saf = s.saf
AND p.cuit= b.cuitl
AND b.sociedad_tipo !='16'
AND r.id_rg = s.regimen830_id
AND s.monto >= '20'
AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
AND p.orden_pago = d.orden
AND p.ejercicio = d.ejercicio
AND p.saf = d.saf
AND d.dd_codigo = '201'
AND s.numero != ''
ORDER BY p.orden_pago";
if (!($res= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 
	

	

//numero de columnas
$columnas1 = mysql_num_fields($res);

$columnas1=$columnas1-1;


//agrego los nombres de las tablas


//agrego contenido a los datos
while($datos = mysql_fetch_assoc($res_ft))
    {
 
	
	for($j=0; $j<$columnas; $j++)
	{
	   if ($j==0)
	      {
			   $fecha_i=explode('-',$datos[mysql_field_name($res_ft,$j)]);
			   $fecha_io=$fecha_i[2].'/'.$fecha_i[1].'/'.$fecha_i[0];
			 echo '06'.$fecha_io ;
		  }
	   elseif ($j==1)
	     {
			
			echo str_pad($datos[mysql_field_name($res_ft,$j)],12,'0',STR_PAD_LEFT);
			 
		 }
		elseif ($j==2)
	     {
			$monto=str_pad($datos[mysql_field_name($res_ft,$j)],20,' ',STR_PAD_LEFT);
			echo str_pad($monto,12,' ',STR_PAD_LEFT);
			 
		 } 
		 elseif ($j==3)
	     {
			
			echo '217'.str_pad($datos[mysql_field_name($res_ft,$j)],3,'0',STR_PAD_LEFT).'1';
			 
		 } 
		elseif ($j==4)
	     {
			$neto=str_pad($datos[mysql_field_name($res_ft,$j)],14,' ',STR_PAD_LEFT);
			
			 
		 } 
		elseif ($j==5)
	      {
			   $fecha_p=explode('-',$datos[mysql_field_name($res_ft,$j)]);
			   $fecha_po=$fecha_p[2].'/'.$fecha_p[1].'/'.$fecha_p[0];
			 echo $neto.$fecha_po.'010';
		  }
		elseif ($j==6)
	     {
			$var='0.00';
			echo str_pad($datos[mysql_field_name($res_ft,$j)],14,' ',STR_PAD_LEFT).str_pad($var,6,' ',STR_PAD_LEFT);
			 
		 }  
		  elseif ($j==7)
	     {
			$var1='80';
			$var2='00000000000000';
			$comp=explode('-',$datos[mysql_field_name($res_ft,8)]);
			 $var3=$comp[0].''.$comp[1].''.$comp[2];
			
			$cuit=$datos[mysql_field_name($res,$j)];
			echo str_pad($var1,12,' ',STR_PAD_LEFT).$cuit.str_pad($var2,23,' ',STR_PAD_LEFT).$var3;
		 }  
		  
	}

	echo chr(13).chr(10);

	}

while($datos = mysql_fetch_assoc($res))
    {
 
	
	for($j=0; $j<$columnas1; $j++)
	{
	   if ($j==0)
	      {
			   $fecha_i=explode('-',$datos[mysql_field_name($res,$j)]);
			   $fecha_io=$fecha_i[2].'/'.$fecha_i[1].'/'.$fecha_i[0];
			 echo '06'.$fecha_io ;
		  }
	   elseif ($j==1)
	     {
			
			echo str_pad($datos[mysql_field_name($res,$j)],12,' ',STR_PAD_RIGHT);
			 
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
			/*$var2='00000000000000';
			$var3=$datos[mysql_field_name($res_ft,8)];
			$cuit=$datos[mysql_field_name($res,$j)];
			echo str_pad($var1,12,' ',STR_PAD_LEFT).$cuit.str_pad($var2,23,' ',STR_PAD_LEFT).str_pad($var3,31,' ',STR_PAD_LEFT);
			*/
			
			$var2='00000000000000';
			$comp=explode('-',$datos[mysql_field_name($res_ft,8)]);
			 $var3=$comp[0].''.$comp[1].''.$comp[2];
			
			$cuit=$datos[mysql_field_name($res,$j)];
			echo str_pad($var1,12,' ',STR_PAD_LEFT).$cuit.str_pad($var2,23,' ',STR_PAD_LEFT).$var3;
			   
		 }  
		  
	}

	

	}

/////////////////////////UTES//////////



	
$sql="SELECT s.fecha_io AS fecha_inicio, s.orden, p.importe AS monto, r.codigo, s.neto AS base_imponible, p.fecha AS fecha_pago, d.importe AS retnecion, p.cuit,s.numero
FROM orden_pago AS p, sicore AS s, anexorg830 AS r,dd_retenciones as d,beneficiarios_aprobados as b
WHERE p.orden_pago = s.orden
AND p.ejercicio = s.ejercicio
AND p.saf = s.saf
AND p.cuit= b.cuitl
AND b.sociedad_tipo ='16'
AND r.id_rg = s.regimen830_id
AND s.monto >= '20'
AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
AND p.orden_pago = d.orden
AND p.ejercicio = d.ejercicio
AND p.saf = d.saf
AND d.dd_codigo = '201'
AND s.numero != ''
ORDER BY p.orden_pago
";
if (!($res_ft= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario_ute";
      echo $cuerpo1;
      //.....................................................................
    } 	
	






$columnas = mysql_num_fields($res_ft);





//agrego los nombres de las tablas


//agrego contenido a los datos
while($datos = mysql_fetch_assoc($res_ft))
    {
		$cuit_ute=$datos[mysql_field_name($res_ft,7)]; 
		$sql="SELECT `cuit_u1` , `cuit_u2` , `cuit_u3` , `cuit_u4` , `cuit_u5` , `cuit_u6` , `por_u1` , `por_u2` , `por_u3` , `por_u4` , `por_u5` , `por_u6` FROM beneficiarios_aprobados as b
		WHERE `cuitl`='$cuit_ute'
		";
		if (!($ute= mysql_query($sql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar tipo beneficiario_ute_d";
			  echo $cuerpo1;
			  //.....................................................................
			} 	
			
      $f_utes=mysql_fetch_assoc($ute);
	  $columnas_u = mysql_num_fields($ute);

     
	for($uc=0; $uc< 6; $uc++)
	 {
		
	 
  $por=$f_utes[mysql_field_name($ute,$uc+6)];
	 
    if($f_utes[mysql_field_name($ute,$uc)]!='')	
	  {	
	  
   $j=0;
	  
	   
	for($j=0; $j<$columnas; $j++)
	 {
		 
  	   if ($j==0)
	      {
			   $fecha_i=explode('-',$datos[mysql_field_name($res_ft,$j)]);
			   $fecha_io=$fecha_i[2].'/'.$fecha_i[1].'/'.$fecha_i[0];
			 echo '06'.$fecha_io ;
		  }
	   elseif ($j==1)
	     {
			
			echo str_pad($datos[mysql_field_name($res_ft,$j)],12,' ',STR_PAD_RIGHT);
			 
		 }
		elseif ($j==2)
	     {
			$monto=str_pad($datos[mysql_field_name($res_ft,$j)],20,' ',STR_PAD_LEFT);
			echo str_pad($monto,12,' ',STR_PAD_LEFT);
			 
		 } 
		 elseif ($j==3)
	     {
			
			echo '217'.str_pad($datos[mysql_field_name($res_ft,$j)],3,'0',STR_PAD_LEFT).'1';
			 
		 } 
		elseif ($j==4)
	     {
			$neto=str_pad($datos[mysql_field_name($res_ft,$j)],14,' ',STR_PAD_LEFT);
			
			 
		 } 
		elseif ($j==5)
	      {
			   $fecha_p=explode('-',$datos[mysql_field_name($res_ft,$j)]);
			   $fecha_po=$fecha_p[2].'/'.$fecha_p[1].'/'.$fecha_p[0];
			 echo $neto.$fecha_po.'010';
		  }
		elseif ($j==6)
	     {
			 $ret_v=$datos[mysql_field_name($res_ft,$j)]/100*$por;
			$var='0.00';
			echo str_pad($ret_v,14,' ',STR_PAD_LEFT).str_pad($var,6,' ',STR_PAD_LEFT);
			 
		 }  
		  elseif ($j==7)
	     {
			$var1='80';
			$var2='0000000';
			$comp=explode('-',$datos[mysql_field_name($res_ft,8)]);
			 $var3=$comp[0].''.$comp[1].''.$comp[2];
			
			$cuit=$f_utes[mysql_field_name($ute,$uc)];
			echo str_pad($var1,12,' ',STR_PAD_LEFT).$cuit.$var2.$var3;
			   
		 }  
		  
	    }
	
		 
	  }
	
	 }
	
 
		

	}


///////////////////////////////////

$sql="SELECT s.fecha_io AS fecha_inicio, s.orden, p.importe AS monto, r.codigo, s.neto AS base_imponible, p.fecha AS fecha_pago, d.importe AS retnecion, p.cuit,s.numero
FROM orden_pago_fp AS p, sicore AS s, anexorg830 AS r,dd_retenciones as d,beneficiarios_aprobados as b
WHERE p.orden_pago = s.orden
AND p.ejercicio = s.ejercicio
AND p.saf = s.saf
AND p.cuit= b.cuitl
AND b.sociedad_tipo ='16'
AND r.id_rg = s.regimen830_id
AND s.monto >= '20'
AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
AND p.orden_pago = d.orden
AND p.ejercicio = d.ejercicio
AND p.saf = d.saf
AND d.dd_codigo = '201'
AND s.numero != ''
ORDER BY p.orden_pago";
if (!($res_ft= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario_ute_1";
      echo $cuerpo1;
      //.....................................................................
    } 
	

	

//numero de columnas
$columnas1 = mysql_num_fields($res_ft);

while($datos = mysql_fetch_assoc($res_ft))
    {
 	$cuit_ute=$datos[mysql_field_name($res_ft,7)]; 
		$sql="SELECT `cuit_u1` , `cuit_u2` , `cuit_u3` , `cuit_u4` , `cuit_u5` , `cuit_u6` , `por_u1` , `por_u2` , `por_u3` , `por_u4` , `por_u5` , `por_u6` FROM beneficiarios_aprobados as b
		WHERE `cuitl`='$cuit_ute'
		";
		if (!($ute= mysql_query($sql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar tipo beneficiario_ute_d1";
			  echo $cuerpo1;
			  //.....................................................................
			} 	
	 $columnas_u = mysql_num_fields($ute);		
    $f_utes=mysql_fetch_assoc($ute);
	
	 

     
	for($uc=0; $uc< 6; $uc++)
	 {  
	 $por=$f_utes[mysql_field_name($ute,$uc+6)];
	 
    if($f_utes[mysql_field_name($ute,$uc)]!='')	
	  {	
	  
   $j=0;
	
	for($j=0; $j<$columnas1; $j++)
	{
	   if ($j==0)
	      {
			   $fecha_i=explode('-',$datos[mysql_field_name($res,$j)]);
			   $fecha_io=$fecha_i[2].'/'.$fecha_i[1].'/'.$fecha_i[0];
			 echo '06'.$fecha_io ;
		  }
	   elseif ($j==1)
	     {
			
			echo str_pad($datos[mysql_field_name($res,$j)],12,' ',STR_PAD_RIGHT);
			 
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
			 $ret_v=$datos[mysql_field_name($res,$j)]/100*$por;
			$var='0.00';
			echo str_pad($ret_v,14,' ',STR_PAD_LEFT).str_pad($var,6,' ',STR_PAD_LEFT);
			 
		 }  
		  elseif ($j==7)
	     {
			$var1='80';
			$var2='000000000000000';
			$comp=explode('-',$datos[mysql_field_name($res_ft,8)]);
			 $var3=$comp[0].''.$comp[1].''.$comp[2];
			
			$cuit=$f_utes[mysql_field_name($ute,$uc)];
			echo str_pad($var1,12,' ',STR_PAD_LEFT).$cuit.$var2.$var3;
			   
		 }  
		  
	    }
	echo chr(13).chr(10);
		 
	  }
	
	 }
	
 
		

	}



?>