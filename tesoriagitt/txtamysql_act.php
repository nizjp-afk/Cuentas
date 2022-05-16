<?php

   include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	$c=0;
	$archivo = file("act_afip.txt");
    $cuantos = count($archivo);
    for ($var=0;$var<$cuantos;$var++)
	{
	    $linea=  explode(";",$archivo[$var]);
	       echo $cod_a= trim($linea[0]);
		echo $cod_ac= ltrim($linea[0],'0');
		echo '<br>';
		   echo $cod_n= utf8_decode(trim($linea[1]));
		echo '<br>';
		   echo $cod_l= utf8_decode(trim($linea[2]));
	
		
		
	echo	 $sql = "SELECT * FROM actividad where trim(nuevo_codigo)='$cod_ac'  ";
					  if (!($actividad= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar actividad";
							  echo $cuerpo1;
							  //.....................................................................
							}   
     
	
		echo '<br>';
		echo $cant = mysql_num_rows($actividad);
		echo '<br>';
		if ($cant > 0)
		{
		echo 'paso';
	        $f_actividad=mysql_fetch_array($actividad);
	    		  
		     $id=  trim($f_actividad['id_codigo']);
		  
		   
	     
			echo $ssql = "update `actividad` set id_actividad='$cod_a', nombre_actividad='$cod_n',estado='A',nombre_largo='$cod_l' where id_codigo='$id' ";
				 if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
				{
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al actualizar actividad";
				 
				  //.....................................................................
				}		
				
          }
		 else
		 {
			$sql= "INSERT INTO `actividad` (`id_actividad`, `nombre_actividad`, `nombre_largo`,`nuevo_codigo`) VALUES ('$cod_a','$cod_n','$cod_l','$cod_a')";
		
		 if (!($actividad_i= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al insertar actividad";
							  echo $cuerpo1;
							  //.....................................................................
							} 
		 
			 
		 }
		  
		
	
	}



	?>