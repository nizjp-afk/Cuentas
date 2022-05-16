<?
 
//error_reporting ( E_ERROR );
   include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');

    $archivo = file("codigo_sipaf_b.txt");
    $cuantos = count($archivo);
    for ($var=0;$var<$cuantos;$var++)
	{
	    $linea=  explode(";",$archivo[$var]);
	   echo $codigo= $linea[0];
		echo '<br>';
		
		
		
		echo $cuit= $linea[2];
		echo '<br>';
		
		
		
	  
	   $sql = "UPDATE `codigos_sipaf` SET `cuit` = '$cuit' where codigo='$codigo'" ;
	  	  
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