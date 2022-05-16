<?php

   error_reporting (E_ERROR); 
   header("Content-Type: plain/text");
header("Content-Disposition: Attachment; filename=beneficiario.txt");
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
  

	
$sql="SELECT  `beneficiarios_aprobados`.`cuitl`, CONCAT(`beneficiarios_aprobados`.`apellido` ,' ', `beneficiarios_aprobados`.`nombre`,' ', `beneficiarios_aprobados`.`razon_social`)AS Denominacion,CONCAT(`beneficiarios_aprobados`.`direccion_f_calle` ,' ',`beneficiarios_aprobados`.`direccion_f_nro`) as Direccion , `localidades`.`descripcion` as Localidades, `provincias`.`cod_sicore` as provincia , `beneficiarios_aprobados`.`codigo_f_postal`,cuit_tipo 
FROM `beneficiarios_aprobados`,`localidades` , `provincias` 
WHERE ( 
 (`beneficiarios_aprobados`.`direccion_f_localidad` = localidades.id_localidades ) 
 
AND ( `beneficiarios_aprobados`.`direccion_f_provincia` = provincias.codprovincia)


) ORDER BY `beneficiarios_aprobados`.`id_beneficiario`, `beneficiarios_aprobados`.`fecha_aprobacion` ASC
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






//agrego contenido a los datos
while($datos = mysql_fetch_assoc($res_ft))
    {
 
	
	for($j=0; $j<$columnas; $j++)
	{
	   if ($j==0)
	      {
			   echo str_pad($datos[mysql_field_name($res_ft,$j)],11,' ');
		  }
	   elseif ($j==1)
	     {
			
			echo str_pad($datos[mysql_field_name($res_ft,$j)],20,' ');
			 
		 }
		elseif ($j==2)
	     {
			echo str_pad($datos[mysql_field_name($res_ft,$j)],20,' ');
			 
		 } 
		 elseif ($j==3)
	     {
			
			echo str_pad($datos[mysql_field_name($res_ft,$j)],20,' ');
			 
		 } 
		elseif ($j==4)
	     {
			echo str_pad($datos[mysql_field_name($res_ft,$j)],2,'0');
			
			 
		 } 
		elseif ($j==5)
	      {
			  echo str_pad($datos[mysql_field_name($res_ft,$j)],8,' ');
		  }
		elseif ($j==6)
		   {
			   $cui_d=$datos[mysql_field_name($res_ft,$j)];
			   if($cui_d==1)
			     {
					 $cuid_v=80;
				 }
				if($cui_d==2)
			     {
					 $cuid_v=86;
				 } 
			echo str_pad($cuid_v,2,'0');
			 
		 }  
		 
		  
	}

	echo chr(13).chr(10);

	}



?>