<?php
//conexion
 error_reporting ( E_ERROR );  

	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
  
	
   
     $ssql = "TRUNCATE TABLE `op_pendientes_fp_r`";
     if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar truncate";
      echo $cuerpo1;
      //.....................................................................
    }   
	
	 
	

if ($conn_access = odbc_connect ( "orden_pago_fp", "", ""))
{
  // echo "Conectado correctamente";
    $ssql = "SELECT OP_Pendientes.[Ejercicio], OP_Pendientes.[Fecha_OP], OP_Pendientes.[Numero_OP], OP_Pendientes.[Numero_Int], OP_Pendientes.[Saf], OP_Pendientes.[Fuente], OP_Pendientes.[Clase], OP_Pendientes.[Beneficiario], OP_Pendientes.[Concepto], OP_Pendientes.[Imp_orden], OP_Pendientes.[Total_Pagado], OP_Pendientes.[Saldos],OP_Pendientes.[cuit],OP_Pendientes.[ESTADO],OP_Pendientes.[Form_importe]
FROM OP_Pendientes
ORDER BY Ejercicio,Numero_OP;";
    if($rs_access = odbc_exec ($conn_access, $ssql))
	 {
    //   echo "La sentencia se ejecut� correctamente";
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
		 
		  echo $total=$fila->Form_importe;
		   if ($estado=='NORMAL'){$valor='N';}
		  if ($estado=='BLOQUEADO'){$valor='R';}
		  if ($estado=='BAJA'){$valor='B';}
	   
	     echo $Numero_Int.'-'.$Numero_OP.'-'.$Beneficiario;
		 echo '<br>';
		 ///insertar en base Sigcom tabla op_pendiente
		 
			 
							  $ssql = "INSERT INTO `op_pendientes_fp_r`
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
    echo "Error en la conexi�n con la base de datos";
}
   
 
 
?>

   

