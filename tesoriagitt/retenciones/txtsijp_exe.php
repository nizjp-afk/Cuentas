<?php

    error_reporting (E_ERROR); 
   header("Content-Type: plain/text");
header("Content-Disposition: Attachment; filename=control_ss.xls");
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
  

$sql="SELECT distinct r.codigo,p.cuit,p.fecha,s.numero_ss, p.total as total,s.monto AS retnecion,s.id
FROM orden_pago AS p, sicore_ss AS s, anexoss AS r
WHERE p.orden_pago = s.orden
AND p.ejercicio = s.ejercicio
AND p.saf = s.saf
AND r.id_ss = s.ss_id
AND NOT(p.cuit = '33709641099' 
or p.cuit = '30711009791'
or p.cuit = '30711315744' 
or p.cuit = '30709842931' 
or p.cuit = '30711051801'
or p.cuit = '30710994907'
or p.cuit = '30712044558'
or p.cuit = '30710170548'
or p.cuit = '30710135173'
or p.cuit = '33710591089'
or p.cuit = '30710354584'
or p.cuit = '30710925190'
or p.cuit = '30711068674'
or p.cuit = '30712251421'
or p.cuit = '30711194807'
or p.cuit = '30711044341'
or p.cuit = '30711025134'
or p.cuit = '30711789622')
AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
AND s.monto >= '40'
AND s.numero_ss > '0'
ORDER BY s.numero_ss,p.fecha asc";
if (!($res_ft= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar ordenes";
      echo $cuerpo1;
      //.....................................................................
    } 

///numeracion para el sistema de seguridad social /////
$sql="SELECT * FROM `num_ss`";
if (!($num_ss= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo numero";
      echo $cuerpo1;
      //.....................................................................
    } 
$f_num_ss = mysql_fetch_array($num_ss);

$valor=$f_num_ss['numero'];

/////////////////////////////



$columnas = mysql_num_fields($res_ft);




$var_cuittes='20040100          30671853535353';

//agrego los nombres de las tablas


//agrego contenido a los datos

while($datos = mysql_fetch_assoc($res_ft))
     {
    
	
	for($j=0; $j<$columnas; $j++)
	{
	   if ($j==0)
	      {
			
			echo str_pad($var_cuittes.$datos[mysql_field_name($res_ft,$j)],3,' ',STR_PAD_LEFT);
			 
		 } 
			 
	   elseif ($j==1)
	     {
			
			echo $datos[mysql_field_name($res_ft,$j)];
			 
		 }
		elseif ($j==2)
	     {
			 $monto='06';
			 $fecha_p=explode('-',$datos[mysql_field_name($res_ft,$j)]);
			 $fecha_po=$fecha_p[2].'/'.$fecha_p[1].'/'.$fecha_p[0];
			 echo $fecha_po.$monto.$fecha_po;
			 
		 } 
		elseif ($j==3)
	     {
			 $var_b='    ';
			  $numero = $datos[mysql_field_name($res_ft,$j)];
			 if($numero=='0')
			   {
		         echo str_pad($valor,12,'0',STR_PAD_LEFT).$var_b;
				 
				/* $consulta = "UPDATE sicore_ss SET numero_ss = '$valor' where id='$id'"; 
					if (!($r_ss = mysql_query($consulta, $conexion_mysql)))
					{
					  //.....................................................................
					  // INFORMA  DE ERROR PRODUCIDO//
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar sumar remito";
						   
					  echo $cuerpo1;
					  exit;
					  //.....................................................................
					  //.....................................................................
					}
				 
				 */
				 
				 $valor=$valor+1;
			 
			  }
			  else
			    {
		           echo str_pad($numero,12,'0',STR_PAD_LEFT).$var_b;
			   }
			 
		  
			   
		 }  
		 elseif ($j==4)
	     {
		   echo str_pad($datos[mysql_field_name($res_ft,$j)],14,'0',STR_PAD_LEFT);
			   
		 }  
		elseif ($j==5)
	     {
			 $espacio='   ';
			 
			   echo str_pad($datos[mysql_field_name($res_ft,$j)],14,'0',STR_PAD_LEFT);
			  echo str_pad($espacio,79,' ',STR_PAD_LEFT);
			
			  
			   
		 }   
		  
	}

	echo chr(13).chr(10);
	}


 /* $consulta = "UPDATE num_ss SET numero = '$valor'"; 
    if (!($r_remito = mysql_query($consulta, $conexion_mysql)))
    {
      //.....................................................................
      // INFORMA  DE ERROR PRODUCIDO//
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar sumar remito";
           
      echo $cuerpo1;
      exit;
      //.....................................................................
      //.....................................................................
    }
	
	*/
	
	$sql="SELECT distinct r.codigo,p.cuit,p.fecha,s.numero_ss, p.total as total,s.monto AS retnecion,s.id
FROM orden_pago_fp AS p, sicore_ss AS s, anexoss AS r
WHERE p.orden_pago = s.orden
AND p.ejercicio = s.ejercicio
AND p.saf = s.saf
AND r.id_ss = s.ss_id   
AND NOT(p.cuit = '33709641099' 
or p.cuit = '30711009791'
or p.cuit = '30711315744' 
or p.cuit = '30709842931' 
or p.cuit = '30711051801'
or p.cuit = '30710994907'
or p.cuit = '30712044558'
or p.cuit = '30710170548'
or p.cuit = '30710135173'
or p.cuit = '33710591089'
or p.cuit = '30710354584'
or p.cuit = '30710925190'
or p.cuit = '30711068674'
or p.cuit = '30712251421'
or p.cuit = '30711194807'
or p.cuit = '30711044341'
or p.cuit = '30711025134'
or p.cuit = '30711789622')
AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
AND s.monto >= '40'
AND s.numero_ss > '0'
ORDER BY s.numero_ss, p.fecha asc";
if (!($res= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo orden";
      echo $cuerpo1;
      //.....................................................................
    } 
	


///numeracion para el sistema de seguridad social /////
$sql="SELECT * FROM `num_ss`";
if (!($num_ss= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario1";
      echo $cuerpo1;
      //.....................................................................
    } 
$f_num_ss = mysql_fetch_array($num_ss);

$valor=$f_num_ss['numero'];

/////////////////////////////


//numero de columnas
$columnas = mysql_num_fields($res);





//agrego los nombres de las tablas


//agrego contenido a los datos
while($datos1 = mysql_fetch_assoc($res))
    {
    
	
	for($j=0; $j<$columnas; $j++)
	{
	   if ($j==0)
	      {
			
			echo str_pad($var_cuittes.$datos1[mysql_field_name($res,$j)],3,' ',STR_PAD_LEFT);
			 
		 } 
			 
	   elseif ($j==1)
	     {
			
			echo $datos1[mysql_field_name($res,$j)];
			 
		 }
		elseif ($j==2)
	     {
			 $monto='06';
			 $fecha_p=explode('-',$datos1[mysql_field_name($res,$j)]);
			 $fecha_po=$fecha_p[2].'/'.$fecha_p[1].'/'.$fecha_p[0];
			 echo $fecha_po.$monto.$fecha_po;
			 
		 } 
		elseif ($j==3)
	     {
			 $var_b='    ';
			  $numero = $datos1[mysql_field_name($res,$j)];
			 if($numero=='0')
			   {
		         echo str_pad($valor,12,'0',STR_PAD_LEFT).$var_b;
				 
				/* $consulta = "UPDATE sicore_ss SET numero_ss = '$valor' where id='$id'"; 
					if (!($r_ss = mysql_query($consulta, $conexion_mysql)))
					{
					  //.....................................................................
					  // INFORMA  DE ERROR PRODUCIDO//
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar sumar remito";
						   
					  echo $cuerpo1;
					  exit;
					  //.....................................................................
					  //.....................................................................
					}
				 
				 */
				 
				 $valor=$valor+1;
			 
			  }
			  else
			    {
		           echo str_pad($numero,12,'0',STR_PAD_LEFT).$var_b;
			   }
			 
		  
			   
		 }  
		 elseif ($j==4)
	     {
		   echo str_pad($datos1[mysql_field_name($res,$j)],14,'0',STR_PAD_LEFT);
			   
		 }  
		elseif ($j==5)
	     {
			 $espacio='   ';
			 
			   echo str_pad($datos1[mysql_field_name($res,$j)],14,'0',STR_PAD_LEFT);
			  echo str_pad($espacio,79,' ',STR_PAD_LEFT);
			
			  
			   
		 }   
	}

	echo chr(13).chr(10);

	}

/*$consulta = "UPDATE num_ss SET numero = '$valor'"; 
    if (!($r_remito = mysql_query($consulta, $conexion_mysql)))
    {
      //.....................................................................
      // INFORMA  DE ERROR PRODUCIDO//
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar sumar remito";
           
      echo $cuerpo1;
      exit;
      //.....................................................................
      //.....................................................................
    }

*/


?>