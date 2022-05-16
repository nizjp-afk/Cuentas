<?php
/*
$pv='000';
$cc='0000000000';
for ($cl=1; $cl < 11; $cl++)
 {
echo $cl;
 echo "<br>";	 
switch ($cl)
                           {
							  case 1:
							          $vcc=substr($cc,0,-$cl);
									  echo "<br>";
							       echo  $valor1=$pv.'-'.$vcc.$cl;  
									  echo "<br>";   
							  break;
							  case 2:
							     echo $vcc=substr($cc,-$cl);
									  echo "<br>";
							         $valor1=$pv.'-'.$vcc.$$cl;  
									  echo "<br>";
								 break;
								 
								  case 3:
							        echo $vcc=substr($cc,-$cl);
									  echo "<br>";
							         $valor1=$pv.'-'.$vcc.$$cl;  
									  echo "<br>";     
							  break;
							  case 4:
							     echo $vcc=substr($cc,-$cl);
									  echo "<br>";
							         $valor1=$pv.'-'.$vcc.$$cl;  
									  echo "<br>";
								 break;
								  case 5:
							         $vcc=substr($cc,-$cl);
							         $valor1=$pv.'-'.$vcc.$$cl;     
							  break;
							  case 6:
							      $vcc=substr($cc,-$cl);
							         $valor1=$pv.'-'.$vcc.$$cl; 
								 break;
								  case 7:
							         $vcc=substr($cc,-$cl);
							         $valor1=$pv.'-'.$vcc.$valor;     
							  break;
							  case 8:
							      $vcc=substr($cc,-$cl);
							         $valor1=$pv.'-'.$vcc.$valor; 
								 break;
								  case 9:
							         $vcc=substr($cc,-$cl);
							         $valor1=$pv.'-'.$vcc.$valor;     
							  break;
							  case 10:
							      
							         $valor1=$pv.'-'.$valor; 
								 break;
								 
						   }
 }
						 exit;  

*/
  

    error_reporting (E_ERROR); 
	
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
  

$sql="SELECT p.fecha AS FECHA, s.orden AS OP, p.cuit AS CUIT, s.numero AS CERTIFICADO, b.ingreso_bruto AS INSCRIPCION, CONCAT( b.apellido, ' ', b.nombre, ' ', b.razon_social ) AS BENEFICIARIO, CONCAT( b.direccion_f_calle, ' ', b.direccion_f_nro ) AS DOMICILIO, s.bruto AS IMPORTE, s.alicuota AS ALICUOTA, s.neto AS BASE_IMPONIBLE, s.monto AS RETENCION, s.id
FROM orden_pago_fp AS p, sicore_ib AS s,  beneficiarios_aprobados AS b
WHERE p.orden_pago = s.orden
AND b.cuitl = p.cuit
AND p.ejercicio = s.ejercicio
AND p.saf = s.saf
AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
and s. monto > '0'
AND s.numero = ''
ORDER BY p.orden_pago";
if (!($res_ft= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar ordenes";
      echo $cuerpo1;
      //.....................................................................
    } 

///numeracion para el sistema de seguridad social /////
$sql="SELECT * FROM `num_ib`";
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






//agrego los nombres de las tablas


//agrego contenido a los datos

while($datos = mysql_fetch_array($res_ft))
     {
    
	
	        $id = $datos['id'];
	    	 $numero = $datos['numero'];
			 if($numero=='')
			   {
				   	
				    
				$cc='0000000000';   
				$pv='000';
				$cl=strlen($valor);
		$patron = "[[:digit:]]{10}";
		if (!(ereg($patron, $valor)))
		       {
				   for($c=1; $c<11; $c++)
				     {
						 if($c==$cl)
						   {
							    $vcc=substr($cc,0,-$c);
									  echo "<br>";
							       echo  $valor1=$pv.'-'.$vcc.$valor;  
									  echo "<br>";   
						   }
				
								 
						   }
			   }
			   
		        // echo $datos[mysql_field_name($res,$j)];
				 
				 $consulta = "UPDATE sicore_ib SET numero = '$valor1' where id='$id'"; 
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
				 
				 
				 
				 $valor=$valor+1;
			   }
			  
			   
		 
	
	
	}


  $consulta = "UPDATE num_ib SET numero = '$valor'"; 
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
	
	
	
	$sql="SELECT p.fecha AS FECHA, s.orden AS OP, p.cuit AS CUIT, s.numero AS CERTIFICADO, b.ingreso_bruto AS INSCRIPCION, CONCAT( b.apellido, ' ', b.nombre, ' ', b.razon_social ) AS BENEFICIARIO, CONCAT( b.direccion_f_calle, ' ', b.direccion_f_nro ) AS DOMICILIO, s.bruto AS IMPORTE, s.alicuota AS ALICUOTA, s.neto AS BASE_IMPONIBLE, s.monto AS RETENCION, s.id
FROM orden_pago AS p, sicore_ib AS s,  beneficiarios_aprobados AS b
WHERE p.orden_pago = s.orden
AND b.cuitl = p.cuit
AND p.ejercicio = s.ejercicio
AND p.saf = s.saf
AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
and s. monto > '0'
AND s.numero = ''
ORDER BY p.orden_pago";
if (!($res= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo orden";
      echo $cuerpo1;
      //.....................................................................
    } 
	


///numeracion para el sistema de seguridad social /////
$sql="SELECT * FROM `num_ib`";
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
while($datos1 = mysql_fetch_array($res))
    {
     $numero = $datos1['numero'];
	
	 $id = $datos1['id'];
			 if($numero=='')
			   {
				    
				$cc='0000000000';   
				$pv='000';
				$cl=strlen($valor);
		$patron = "[[:digit:]]{10}";
		if (!(ereg($patron, $valor)))
		       {
				   for($c=1; $c<11; $c++)
				     {
						 if($c==$cl)
						   {
							    $vcc=substr($cc,0,-$c);
									  echo "<br>";
							       echo  $valor1=$pv.'-'.$vcc.$valor;  
									  echo "<br>";   
						   }
				
								 
						   }
			   }
			   
				 
				 $consulta = "UPDATE sicore_ib SET numero = '$valor1' where id='$id'"; 
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
				 
				 
				 
				 $valor=$valor+1;
			   }
			  

	}

$consulta = "UPDATE num_ib SET numero = '$valor'"; 
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



	
?>