<?php
//conexion
 error_reporting ( E_ERROR );  

	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
    $i=0;
	
	
	$d_fecha=date('Y-m-d');
	
	$ssql = "SELECT * FROM `control_fecha_fp`";
     if (!($r_cf= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
	$f_cf=mysql_fetch_array($r_cf);
	$t_fecha =$f_cf['c_fecha'];
	
	

     $ssql = "TRUNCATE TABLE `orden_pago_fp`";
     if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }   

	
	/* $ssql = "TRUNCATE TABLE `cumplase`";
     if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    } */  
	
	
	

if ($conn_access = odbc_connect ( "orden_pago", "", ""))
{
  // echo "Conectado correctamente";
    $ssql = "SELECT [ORDEN DE PAGO].CLAVE_UNICA, [ORDEN DE PAGO].BENEFICIARIO, [ORDEN DE PAGO].NRO_DE_SAF, [ORDEN DE PAGO].TIPO_NUMERO, [ORDEN DE PAGO].CONCEPTO, [ORDEN DE PAGO].FORMULARIO, [ORDEN DE PAGO].RETENCION, [PAGOS DE CHEQUES].IMPORTE_DEL_CHEQUE, [PAGOS DE CHEQUES].FECHA_DE_PAGO, [ORDEN DE PAGO].EJERCICIO,[ORDEN DE PAGO].CLASE,[ORDEN DE PAGO].IMPORTE_DEL_FORMULARIO
FROM [ORDEN DE PAGO] INNER JOIN [PAGOS DE CHEQUES] ON [ORDEN DE PAGO].CLAVE_UNICA = [PAGOS DE CHEQUES].clave_Pagos
order by [PAGOS DE CHEQUES].FECHA_DE_PAGO;
";
    if($rs_access = odbc_exec ($conn_access, $ssql))
	 {
    //   echo "La sentencia se ejecutó correctamente";
       while ($fila = odbc_fetch_object($rs_access))
	   {
	     //echo 'paso';
		  $clave=$fila->CLAVE_UNICA;
		  $clase=$fila->CLASE;
		  $cuit=$fila->BENEFICIARIO;
		  $saf=$fila->NRO_DE_SAF;
		  $orden_pago=$fila->TIPO_NUMERO;
		  $concepto=$fila->CONCEPTO;
		  $importe=$fila->FORMULARIO;
		  $retencion=$fila->RETENCION;
		  $total=$fila->IMPORTE_DEL_CHEQUE;
		  $liquido=$fila->IMPORTE_DEL_FORMULARIO;
		  $fecha=$fila->FECHA_DE_PAGO;
		  $ejercicio=$fila->EJERCICIO;
	   
	     if(!($clase=='399'))
		   {
	   	   
		     $ssql = "INSERT INTO `orden_pago` 
		        (`cuit` ,`saf`,`orden_pago`,`fecha`,`concepto`,`importe`,`retencion`,
				 `ejercicio`,`total`,liquido)
				VALUES ('$cuit','$saf','$orden_pago','$fecha','$concepto','$importe',
						'$retencion','$ejercicio','$total','$liquido'); ";
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
		else
		 {
			 $i++;
			 echo 'paso'.$i;
			 echo '<br>';
			 echo $orden_pago.' - '.$fecha.'-'.$importe;
			 echo '<br>';
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
   


$i=0;

     $ssql = "TRUNCATE TABLE `op_pendientes`";
     if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar truncate";
      echo $cuerpo1;
      //.....................................................................
    }   
	
	 
	

if ($conn_access = odbc_connect ( "orden_pago", "", ""))
{
  // echo "Conectado correctamente";
    $ssql = "SELECT OP_Pendientes.[Ejercicio], OP_Pendientes.[Fecha_OP], OP_Pendientes.[Numero_OP], OP_Pendientes.[Numero_Int], OP_Pendientes.[Saf], OP_Pendientes.[Fuente], OP_Pendientes.[Clase], OP_Pendientes.[Beneficiario], OP_Pendientes.[Concepto], OP_Pendientes.[Imp_orden], OP_Pendientes.[Total_Pagado], OP_Pendientes.[Saldos],OP_Pendientes.[cuit]
FROM OP_Pendientes
ORDER BY Ejercicio,Numero_OP;";
    if($rs_access = odbc_exec ($conn_access, $ssql))
	 {
    //   echo "La sentencia se ejecutó correctamente";
       while ($fila = odbc_fetch_object($rs_access))
	   {
	     //echo 'paso';
		  $Ejercicio=$fila->Ejercicio;
		  $Fecha_OP=$fila->Fecha_OP;
		  $Numero_OP=$fila->Numero_OP;
		  $Numero_Int=$fila->Numero_Int;
		  $Saf=$fila->Saf;
		  $Fuente=$fila->Fuente;
		  $Clase=$fila->Clase;
		  $Beneficiario=$fila->Beneficiario;
		  $Concepto=$fila->Concepto;
		  $Imp_orden=$fila->Imp_orden;
		  $Total_Pagado=$fila->Total_Pagado;
		  $Saldos=$fila->Saldos;
		  $d_cuit=$fila->cuit;
	   
	     echo $Numero_Int.'-'.$Numero_OP.'-'.$Beneficiario;
		 echo '<br>';
		 ///insertar en base Sigcom tabla op_pendiente
		 
	if ($t_fecha==$d_fecha)
	    {	 
		  $ssql = "SELECT * FROM `op_pendiente_tmp` WHERE Numero_OP='$Numero_OP'";
				 if (!($r_tmp= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar provincia";
				  echo $cuerpo1;
				  //.....................................................................
				}   
					 $cant=mysql_num_rows($r_tmp);
		
					if(!($cant>0))
					   { 
		 
		 
		 
							  $ssql = "INSERT INTO `op_pendientes`
											  ( `Ejercicio` , `Fecha_OP` , `Numero_OP` , `Numero_Int` , `Saf` , `Fuente` ,
											   `Clase` , `Beneficiario` , `Concepto` , `Imp_orden` , `Total_Pagado` ,
											   `Saldos`,`cuit`)
										   VALUES ('$Ejercicio' , '$Fecha_OP' , '$Numero_OP' , '$Numero_Int' , '$Saf' , 
												   '$Fuente' ,'$Clase' , '$Beneficiario' , '$Concepto' , '$Imp_orden' ,
												   '$Total_Pagado' ,'$Saldos','$d_cuit'); ";
								 if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
								{
								
								  //.....................................................................
								  // informa del error producido
								  $cuerpo1  = "al intentar insertar orden pendiente";
								  echo $cuerpo1;
								  echo $orden_pago;
								   echo $ejercicio;
								  //.....................................................................
								}   
				
		       }
			 
	   }
	  else
	   {
	     $ssql = "INSERT INTO `op_pendientes`
		              ( `Ejercicio` , `Fecha_OP` , `Numero_OP` , `Numero_Int` , `Saf` , `Fuente` ,
					   `Clase` , `Beneficiario` , `Concepto` , `Imp_orden` , `Total_Pagado` ,
					   `Saldos`,`cuit`)
				   VALUES ('$Ejercicio' , '$Fecha_OP' , '$Numero_OP' , '$Numero_Int' , '$Saf' , 
						   '$Fuente' ,'$Clase' , '$Beneficiario' , '$Concepto' , '$Imp_orden' ,
						   '$Total_Pagado' ,'$Saldos','$d_cuit'); ";
				 if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar insertar orden pendiente";
				  echo $cuerpo1;
				  echo $orden_pago;
				   echo $ejercicio;
				  //.....................................................................
				} 
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
   

 
?>

   

