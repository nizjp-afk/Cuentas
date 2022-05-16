<?php

    include('dgti-mysql-var_dbtgp.php');
    include('dgti-intranet-mysql_connect.php');  
	include('dgti-intranet-mysql_select_db.php');
	
	$sql = "SELECT * 
FROM  `orden_pago` 
WHERE  `FORMULARIO` =  'TF'
AND  `concepto` LIKE  '%110%'
AND  `EJERCICIO` =  '2014'";
					  if (!($ret_iibb= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							}   
      
while ($f_ret_iibb=mysql_fetch_array($ret_iibb))
	    {
		  
		  $concepto=  $f_ret_iibb['CONCEPTO'];
		  $conc=explode('---',$concepto);
		  echo  $conc[0].'<br>';
		  echo  $conc[1].'<br>';
		  echo  $conc[2].'<br>';
		  $sac='S.A.C - 1ra Cuota 2014';
		
		  $clave=  $f_ret_iibb['CLAVE'];
		 
		 echo $nuevoc=$conc[0].' --- '.$sac.' --- '.$conc[2].'<br>';
		
		
		
		$sql = "update `orden_pago`  set concepto ='$nuevoc'
		        WHERE  CLAVE='$clave'";
					  if (!($ret_upd= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							} 
		
		}
	
?>