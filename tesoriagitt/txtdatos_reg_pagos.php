<?
 
error_reporting ( E_ERROR );

    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');

    $sql = "SELECT * 
FROM  `orden_pago` 
WHERE  `cuit` =  ''
AND  `ejercicio` =  '2015' " ;
	  	  
			if (!($r_codigo= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf1";
			  echo $cuerpo1;
			  //...............................................
			} 
			echo '<br>';
			
			
			
			while ($f_codigo =  mysql_fetch_array($r_codigo))

		       {
				   
			 $id=$f_codigo['id'];	 
				   
			echo $op=$f_codigo['orden_pago'];echo '<br>';
					 
			 
			 $op_v=split("-",$op);
			 
	 	
		      $saf =   $op_v[1];
			 
			 $tipo =   $op_v[0];
	      
		     $nro_op =      $op_v[2];
	
		     $ejercicio='2015';
		  
		   echo $clave=$ejercicio.''.$saf.''.$tipo.''.$nro_op;echo '<br>';
					 
	

			 include('dgti-mysql-var_dbtgp.php');
			 include('dgti-intranet-mysql_connect.php');  
			 include('dgti-intranet-mysql_select_db.php');

  				  
				
						    $sql = " SELECT * 
										FROM  `orden_pago` 
										WHERE  `CLAVE` =  '$clave' " ;
	  	  
						if (!($d_pago= mysql_query($sql, $conexion_mysql)))
						{
						  //..informa del error producido...................
						  $cuerpo1  = "al buscar saf";
						  echo $cuerpo1;
						  //...............................................
						} 
					
				$f_pago =  mysql_fetch_array($d_pago)	;
				echo  $cuit=  $f_pago['CUIT'];
				 
				 
				  include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
				 
				  $sql = "UPDATE `orden_pago` SET cuit='$cuit' WHERE id='$id' and  `cuit` =  '' AND  `ejercicio` =  '2015' " ;
	  	  
			if (!($u_codigo= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf1";
			  echo $cuerpo1;
			  //...............................................
			} 
			echo '<br>';
					 
					  
				 }
			echo '<br>';
			 
?>