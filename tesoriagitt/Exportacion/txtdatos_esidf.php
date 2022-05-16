<?php
 
//error_reporting ( E_ERROR );
  include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');

    $archivo = file("Exportacion/esidif.txt");
    $cuantos = count($archivo);
    for ($var=0;$var<$cuantos;$var++)
	{
	    $linea=  explode("\t",$archivo[$var]);
	   echo $codigo= $linea[0];
		echo '<br>';
		
		
		
		echo $cuit= trim($linea[1]);
		echo '<br>';
		
		
		
	  
	   $sql = "UPDATE `beneficiarios_aprobados` SET `codigo_esidif` = '$codigo' where cuitl='$cuit' and codigo_esidif = '0' " ;
	  	  
			if (!($r_codigo= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf";
			  echo $cuerpo1;
			  //...............................................
			} 
			echo '<br>';
     }
?>