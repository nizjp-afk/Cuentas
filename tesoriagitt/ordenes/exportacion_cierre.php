<?php
//conexion
 error_reporting ( E_ERROR );  

	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
    $i=0;
	
	
	$ssql = "TRUNCATE TABLE `orden_pago`";
     if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
			{
			
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar provincia";
			  echo $cuerpo1;
			  //.....................................................................
			}   
	
	 
	
	
	
	

if ($conn_access = odbc_connect ( "orden_pago", "", ""))
{
  // echo "Conectado correctamente";
    $ssql = "SELECT [ORDEN DE PAGO].CLAVE_UNICA,[ORDEN DE PAGO].FECHA_DE_INGRESO,[ORDEN DE PAGO].BENEFICIARIO, [ORDEN DE PAGO].NRO_DE_SAF, [ORDEN DE PAGO].TIPO_NUMERO, [ORDEN DE PAGO].CONCEPTO, [ORDEN DE PAGO].FORMULARIO, [ORDEN DE PAGO].RETENCION, [PAGOS DE CHEQUES].IMPORTE_DEL_CHEQUE, [PAGOS DE CHEQUES].FECHA_DE_PAGO, [ORDEN DE PAGO].EJERCICIO,[ORDEN DE PAGO].FUENTE,[ORDEN DE PAGO].CLASE,[ORDEN DE PAGO].IMPORTE_DEL_FORMULARIO
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
		   $fecha_i=$fila->FECHA_DE_INGRESO;
		   $fuente=$fila->FUENTE;
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
		        (`cuit` ,`saf`,`fuente`,`clase`,`orden_pago`,`fecha`,`concepto`,`importe`,`retencion`,
				 `ejercicio`,`total`,liquido,fecha_i)
				VALUES ('$cuit','$saf','$fuente','$clase','$orden_pago','$fecha','$concepto','$importe',
						'$retencion','$ejercicio','$total','$liquido','$fecha_i'); ";
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
    $ssql = "SELECT OP_Pendientes.[Ejercicio], OP_Pendientes.[Fecha_OP], OP_Pendientes.[Numero_OP], OP_Pendientes.[Numero_Int], OP_Pendientes.[Saf], OP_Pendientes.[Fuente], OP_Pendientes.[Clase], OP_Pendientes.[Beneficiario], OP_Pendientes.[Concepto], OP_Pendientes.[Imp_orden], OP_Pendientes.[Total_Pagado], OP_Pendientes.[Saldos],OP_Pendientes.[cuit],OP_Pendientes.[ESTADO],OP_Pendientes.[Form_importe]
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
		  $Saldos=$Imp_orden-$Total_Pagado;
		  $d_cuit=$fila->cuit;
		  echo $estado=$fila->ESTADO;
		 
		  echo $total=$fila->Form_importe;
		  
		  if ($estado=='NORMAL'){$valor='N';}
		  if ($estado=='BLOQUEADO'){$valor='R';}
		  if ($estado=='BAJA'){$valor='B';}
		  if ($estado=='IMPUESTO'){$valor='I';}
	   
	     echo $Numero_Int.'-'.$Numero_OP.'-'.$Beneficiario;
		 echo '<br>';
		 ///insertar en base Sigcom tabla op_pendiente
		 
	     $ssql = "INSERT INTO `op_pendientes`
		              ( `Ejercicio` , `Fecha_OP` , `Numero_OP` , `Numero_Int` , `Saf` , `Fuente` ,
					   `Clase` , `Beneficiario` , `Concepto` , `Imp_orden` , `Total_Pagado` ,
					   `Saldos`,`cuit`,estado,total_orden)
				   VALUES ('$Ejercicio' , '$Fecha_OP' , '$Numero_OP' , '$Numero_Int' , '$Saf' , 
						   '$Fuente' ,'$Clase' , '$Beneficiario' , '$Concepto' , '$Imp_orden' ,
						   '$Total_Pagado','$Saldos','$d_cuit','$valor','$total'); ";
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
       echo "Error al ejecutar la sentencia SQL";
  }
}
else
{
    echo "Error en la conexión con la base de datos";
}


 $ssql = "update `estado_tei` set estado='C' ";
     if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	

/*   
///////////////////actualizacion pendiente retncion
   
     $ssql = "TRUNCATE TABLE `op_pendientes_r`";
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
    $ssql = "SELECT OP_Pendientes.[Ejercicio], OP_Pendientes.[Fecha_OP], OP_Pendientes.[Numero_OP], OP_Pendientes.[Numero_Int], OP_Pendientes.[Saf], OP_Pendientes.[Fuente], OP_Pendientes.[Clase], OP_Pendientes.[Beneficiario], OP_Pendientes.[Concepto], OP_Pendientes.[Imp_orden], OP_Pendientes.[Total_Pagado], OP_Pendientes.[Saldos],OP_Pendientes.[cuit],OP_Pendientes.[ESTADO],OP_Pendientes.[Form_importe]
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
		   echo $estado=$fila->ESTADO;
		 
		  if ($estado=='NORMAL'){$valor='N';}
		  if ($estado=='BLOQUEADO'){$valor='R';}
		  if ($estado=='BAJA'){$valor='B';}
		    if ($estado=='IMPUESTO'){$valor='I';}
		  echo $total=$fila->Form_importe;
	   
	     echo $Numero_Int.'-'.$Numero_OP.'-'.$Beneficiario;
		 echo '<br>';
		 ///insertar en base Sigcom tabla op_pendiente
		 
			 
							  $ssql = "INSERT INTO `op_pendientes_r`
											  ( `Ejercicio` , `Fecha_OP` , `Numero_OP` , `Numero_Int` , `Saf` , `Fuente` ,
											   `Clase` , `Beneficiario` , `Concepto` , `Imp_orden` , `Total_Pagado` ,
											   `Saldos`,`cuit`,estado,total_orden)
										   VALUES ('$Ejercicio' , '$Fecha_OP' , '$Numero_OP' , '$Numero_Int' , '$Saf' , 
												   '$Fuente' ,'$Clase' , '$Beneficiario' , '$Concepto' , '$Imp_orden' ,
												   '$Total_Pagado' ,'$Saldos','$d_cuit','$valor','$total'); ";
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
		   echo "Error al ejecutar la sentencia SQL";
	  }
	}
	else
	{
		echo "Error en la conexión con la base de datos";
	}
 */  
 
?>

   

