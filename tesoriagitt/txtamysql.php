<?php

    include('dgti-mysql-var_dbtgp.php');
    include('dgti-intranet-mysql_connect.php');  
	include('dgti-intranet-mysql_select_db.php');
	/*
	$sql="TRUNCATE TABLE `ret_iibb`"; 
	if (!($ret_iibb= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							} 
							
	$sql="TRUNCATE TABLE `ret_ganancias`"; 
	if (!($ret_iibb= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;3095
							  //.....................................................................
							} 		
	
	
	/*					
	$sql="TRUNCATE TABLE `ret_segsocial`"; 
	if (!($ret_iibb= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							} 						
	*/
	//proceso de retenciones federal
	
	
	$sql = "SELECT *
FROM `ret_iibb` , orden_pago
WHERE `IB_CUIT` = CUIT
AND FECHA_OP = '2014-12-16'
AND FORMULARIO = 'TF'";
					  if (!($ret_iibb= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							}   
      
	
	  $sql = "SELECT *
FROM `ret_segsocial` , orden_pago
WHERE `SS_CUIT` = CUIT
AND FECHA_OP = '2014-12-16'
AND FORMULARIO = 'TF' ";
					  if (!($ret_segsocial= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							}   
							
						
							
 $sql = "SELECT *
FROM `ret_ganancias` , orden_pago
WHERE `Gan_CUIT` = CUIT
AND FECHA_OP = '2014-12-16'
AND FORMULARIO = 'TF' ";
					  if (!($ret_ganancia= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							}   							
		   		   
	
	
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
	
	  while ($f_ret_iibb=mysql_fetch_array($ret_iibb))
	    {
		  
		 $IB_CUIT=  $f_ret_iibb['IB_CUIT'];
		 $IB_FechaLiquidacion =  $f_ret_iibb['IB_FechaLiquidacion'];
		 $IB_ImporteBruto =  $f_ret_iibb['IB_ImporteBruto'];
		 $IB_ImporteNeto =  $f_ret_iibb['IB_ImporteNeto'];
		 $IB_Alicuota = $f_ret_iibb['IB_Alicuota'];
		 $IB_ImporteRetencion =  $f_ret_iibb['IB_ImporteRetencion'];
		 $orden1=$f_ret_iibb['FORMULARIO'];
		 $orden2=$f_ret_iibb['SAF'];
		 $orden3=$f_ret_iibb['NUMERO'];
		 echo $ORDEN=$orden1.'-'.$orden2.'-'.$orden3;
		 echo '<br>';
		 
		
		$sql="INSERT INTO `sicore_ib` (`orden`, `bruto`, `neto`, `ejercicio`, `saf`, `alicuota`, `monto`, `fecha_io`) VALUES ('$ORDEN','$IB_ImporteBruto','$IB_ImporteNeto','2014','992','$IB_Alicuota','$IB_ImporteRetencion','2014-11-01')";
		
		 if (!($insert_ret_iibb= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							} 
		
	
	}
	

	////seguridad social
	
	  while ($f_ret_segsocial=mysql_fetch_array($ret_segsocial))
	    {
		  
		 $IB_CUIT=  $f_ret_segsocial['SS_CUIT'];
		 $SS_CodigoRegimen =  $f_ret_segsocial['SS_CodigoRegimen'];
		 $SS_ImporteRetencion =  $f_ret_segsocial['SS_ImporteRetencion'];
		
		 $orden1=$f_ret_segsocial['FORMULARIO'];
		 $orden2=$f_ret_segsocial['SAF'];
		 $orden3=$f_ret_segsocial['NUMERO'];
		echo  $ORDEN=$orden1.'-'.$orden2.'-'.$orden3;
		 
		  echo '<br>';
		
		$sql="INSERT INTO `sicore_ss` (`orden`,  `ejercicio`, `saf`, `ss_id`, `monto`, `fecha_io`) VALUES ('$ORDEN','2014','992','$SS_CodigoRegimen','$SS_ImporteRetencion','2014-11-01')";
		
		 if (!($insert_ret_iibb= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							} 
		
	
		}
		
	 while ($f_ret_ganancia=mysql_fetch_array($ret_ganancia))
	    {
		 $Gan_CUIT=  $f_ret_ganancia['Gan_CUIT'];
		 $Gan_FechaEmision=  $f_ret_ganancia['Gan_FechaEmision'];
		 $Gan_Comprobante =  $f_ret_ganancia['Gan_Comprobante'];
		 $Gan_Importe =  $f_ret_ganancia['Gan_Importe'];
		
		 $Gan_CodigoRegimen=$f_ret_ganancia['Gan_CodigoRegimen'];
		 $Gan_BaseImponible=$f_ret_ganancia['Gan_BaseImponible'];
		// $Gan_FechaPago=$f_ret_ganancia['Gan_FechaPago'];
		 $Gan_ImporteRetencion=$f_ret_ganancia['Gan_ImporteRetencion'];
		
		 
		 $orden1=$f_ret_ganancia['FORMULARIO'];
		 $orden2=$f_ret_ganancia['SAF'];
		 $orden3=$f_ret_ganancia['NUMERO'];
		echo  $ORDEN=$orden1.'-'.$orden2.'-'.$orden3;
		 
		  echo '<br>';
		
		$sql="INSERT INTO `sicore` (`orden`, `bruto`, `neto`, `ejercicio`, `saf`, `regimen830_id`, `monto`, `fecha_io`) VALUES ('$ORDEN','$Gan_Importe','$Gan_BaseImponible', '2014', '992', '$Gan_CodigoRegimen', '$Gan_ImporteRetencion', '$Gan_FechaEmision');";
		
		 if (!($insert_ret_iibb= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							} 
			
	
	
	
	}
	
	
?>