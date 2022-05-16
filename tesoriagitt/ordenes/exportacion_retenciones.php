<?php
//conexion
 error_reporting ( E_ERROR );  

	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
    $i=0;
	
	
	
	   $ssql = "delete from `dd_retenciones` where ejercicio='2015' ";
     if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }   
	
	
	
	/*

////// base retencion

if ($conn_access = odbc_connect ( "orden_pago", "", ""))
{
  // echo "Conectado correctamente";
    $ssql = "SELECT RETENCIONES.[DD_EJER], RETENCIONES.[DD_SAOD], RETENCIONES.[NRO_FORM], RETENCIONES.[DESC_D], RETENCIONES.[DD_COD_DED], RETENCIONES.[DD_IMPORTE],RETENCIONES.[DD_CUIT]
FROM RETENCIONES;";
    if($rs_access = odbc_exec ($conn_access, $ssql))
	 {
    //   echo "La sentencia se ejecutó correctamente";
       while ($fila = odbc_fetch_object($rs_access))
	   {
	     //echo 'paso';
		  $ejercicio=$fila->DD_EJER;
		  $saf=$fila->DD_SAOD;
		  $orden_pago=$fila->NRO_FORM;
		  $dd_nombre=$fila->DESC_D;
		  $dd_codigo=$fila->DD_COD_DED;
		  $importe=$fila->DD_IMPORTE;
		  $r_cuit=$fila->DD_CUIT;
		   
		 $ssql = "INSERT INTO `dd_retenciones` 
		        (`saf` ,`orden`,`dd_cuit`,`ejercicio`,`dd_nombre`,`dd_codigo`,`importe`)
				VALUES 
				('$saf','$orden_pago','$r_cuit','$ejercicio','$dd_nombre','$dd_codigo','$importe'); ";
				 if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
					{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar provincia";
				  echo $cuerpo1;
				  echo $orden_pago;
				   echo $ejercicio;
				  //.....................................................................
					}    
		 
  }
}
else
  {
       echo "Error al ejecutar la sentencia SQL";
  }
}
else
{
    echo "Error en la conexión con la base de datos";
}
   */

   ////retenciones fondos propios < 2015

/*
     include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');   

	$ssql = "SELECT DISTINCT retencion_saldo.codigo,`saf` , `ejercicio` , CONCAT( `formulario` , '-', `saf` , '-', `numero` )
	        AS orden, `cuit` , nombre, retencion_saldo.codigo , `importe`
	        FROM `retencion_saldo` , cdp1am35
			
	        WHERE retencion_saldo.codigo = cdp1am35.codigo
			and ejercicio < '2015'";

 if (!($r_ret= mysql_query($ssql, $conexion_mysql)))
			{
			
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar provincia1";
			  echo $cuerpo1;
			  //.....................................................................
			}  

    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
    

         while ($fila =  mysql_fetch_array($r_ret))
      	   {
	     //echo 'paso';
		  $ejercicio=$fila['ejercicio'];
		  $saf=$fila['saf'];
		  $orden_pago=$fila['orden'];
		  $dd_nombre=$fila['nombre'];
		  $dd_codigo=$fila['codigo'];
		  $importe=$fila['importe'];
		  $r_cuit=$fila['cuit'];
		   
		 $ssql = "INSERT INTO `dd_retenciones` 
		        (`saf` ,`orden`,`dd_cuit`,`ejercicio`,`dd_nombre`,`dd_codigo`,`importe`)
				VALUES 
				('$saf','$orden_pago','$r_cuit','$ejercicio','$dd_nombre','$dd_codigo','$importe'); ";
				 if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
					{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar provincia2";
				  echo $cuerpo1;
				  echo $orden_pago;
				   echo $ejercicio;
				  //.....................................................................
					}    
		 
  }
  
  */
    ////retenciones fondos propios

     include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');   

	$ssql = "SELECT DISTINCT retencion_saldo.codigo,`saf` , `ejercicio` , CONCAT( `formulario` , '-', `saf` , '-', `numero` )
	        AS orden, `cuit` , nombre, retencion_saldo.codigo , `importe`
	        FROM `retencion_saldo` , ret_esidif
			
	        WHERE retencion_saldo.codigo = ret_esidif.codigo
			and ejercicio='2015' ";

 if (!($r_ret= mysql_query($ssql, $conexion_mysql)))
			{
			
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar provincia3";
			  echo $cuerpo1;
			  //.....................................................................
			}  

    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
    

         while ($fila =  mysql_fetch_array($r_ret))
      	   {
	     //echo 'paso';
		  $ejercicio=$fila['ejercicio'];
		  $saf=$fila['saf'];
		  $orden_pago=$fila['orden'];
		  $dd_nombre=$fila['nombre'];
		  $dd_codigo=$fila['codigo'];
		  $importe=$fila['importe'];
		  $r_cuit=$fila['cuit'];
		   
		 $ssql = "INSERT INTO `dd_retenciones` 
		        (`saf` ,`orden`,`dd_cuit`,`ejercicio`,`dd_nombre`,`dd_codigo`,`importe`)
				VALUES 
				('$saf','$orden_pago','$r_cuit','$ejercicio','$dd_nombre','$dd_codigo','$importe'); ";
				 if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
					{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar provincia4";
				  echo $cuerpo1;
				  echo $orden_pago;
				   echo $ejercicio;
				  //.....................................................................
					}    
		 
  }
  
  
  
  
   
?>