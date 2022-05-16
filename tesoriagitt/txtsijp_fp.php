<?php

  //  error_reporting (E_ERROR); 
   header("Content-Type: plain/text");
header("Content-Disposition: Attachment; filename=seguridadsocial.txt");
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
  
$sql="SELECT r.codigo,p.cuit,p.fecha,d.importe AS retnecion,s.id,s.numero_ss
FROM orden_pago_fp AS p, sicore_ss AS s, anexoss AS r,dd_retenciones as d
WHERE p.orden_pago = s.orden
AND p.ejercicio = s.ejercicio
AND p.saf = s.saf
AND r.id_ss = s.ss_id   
AND NOT(p.cuit = '33709641099' 
or p.cuit = '30711009791'
or p.cuit = '30711315744' 
or p.cuit = '30709842931' 
or p.cuit = '30711051801'
or p.cuit = '30710994907')
AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
AND s.monto >= '40'
AND p.orden_pago = d.orden
AND p.ejercicio = d.ejercicio
AND p.saf = d.saf
AND (d.dd_codigo = '99' or d.dd_codigo = '172') 
AND s.numero_ss = '0'
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
			
			echo str_pad($datos[mysql_field_name($res,$j)],3,' ',STR_PAD_LEFT);
			 
		 } 
			 
	   elseif ($j==1)
	     {
			
			echo $datos[mysql_field_name($res,$j)];
			 
		 }
		elseif ($j==2)
	     {
			 $monto='0.00';
			 $fecha_p=explode('-',$datos[mysql_field_name($res,$j)]);
			 $fecha_po=$fecha_p[2].'/'.$fecha_p[1].'/'.$fecha_p[0];
			 echo str_pad($monto,11,' ',STR_PAD_LEFT).$fecha_po;
			 
		 } 
		elseif ($j==3)
	     {
		   echo str_pad($datos[mysql_field_name($res,$j)],11,' ',STR_PAD_LEFT);
			   
		 }  
		 elseif ($j==4)
	     {
		   $id=$datos[mysql_field_name($res,$j)];
			   
		 }  
		 
		elseif ($j==5)
	     {
			 $numero = $datos[mysql_field_name($res,$j)];
			 if($numero=='0')
			   {
		         echo str_pad($valor,5,' ',STR_PAD_LEFT);
				  $consulta = "UPDATE sicore_ss SET numero_ss = '$valor' where id='$id'"; 
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
			  else
			    {
		         echo str_pad($numero,5,' ',STR_PAD_LEFT);
			   }
			   
		 }    
	}

	echo chr(13).chr(10);

	}

$consulta = "UPDATE num_ss SET numero = '$valor'"; 
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





//agrego los nombres de las tablas


//agrego contenido a los datos
?>