<?php
error_reporting ( E_ERROR );
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
	
	
	
    $archivo = file("txt_afip/seguridad.txt");
    $cuantos = count($archivo);
    for ($var=0;$var<$cuantos;$var++)
	{
	     $linea= $archivo[$var];   //TODO EN ARCHIVO EN UNA LINEA
		echo '<br>';
		
		  $op_v=substr($linea,68,13);echo '<br>'; 
		
		 $op_saf=trim(ltrim($op_v,'0'));echo '<br>';
		$importe=substr($linea,98,109);echo '<br>';
		
		 $importe=trim(ltrim($importe,'0'));echo '<br>';
		
		echo $codigo=substr($linea,32,3);echo '<br>';
		
		 $cuit=substr($linea,35,11);echo '<br>';
		
		 $fecha_io=substr($linea,46,10);echo '<br>';
		$fecha_i=split("/",$fecha_io);
		
		 $fecha_io=$fecha_i[2].'-'.$fecha_i[1].'-'.$fecha_i[0];
		
		
		
	echo	$ssql = "SELECT id_ss FROM anexoss where codigo='$codigo'  ";
				 if (!($r_rg= mysql_query($ssql, $conexion_mysql)))
				{
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar tipo de iva";
				  echo $cuerpo1;
				  //.....................................................................
				}   
		
		 $f_rg= mysql_fetch_array ($r_rg);
		echo  $reg = $f_rg['id_ss']; 
	echo '<br>';
		
		echo $sql = "update sicore_ss set ss_id='$reg' WHERE op_saf='$op_saf' AND fecha_io='$fecha_io' AND monto='$importe' and ss_id='0'";
					  if (!($r_upd= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							}
		
	 	

		echo '<br>';
		 
		 		
	   
							
	}
	
?>
	
