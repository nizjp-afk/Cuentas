<?php
//conexion
 error_reporting ( E_ERROR );  

	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
    $i=0;
	
	
	$d_fecha=date('Y-m-d');
	
	$ssql = "SELECT * FROM `control_fecha`";
     if (!($r_cf= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
	$f_cf=mysql_fetch_array($r_cf);
	$t_fecha =$f_cf['c_fecha'];
	
	
$i=0;

     $ssql = "delete from `op_pendientes` where ejercicio='2014'";
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
where Ejercicio=2014
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
		  if ($estado=='NORMAL'){$valor='N';}
		  if ($estado=='BLOQUEADO'){$valor='R';}
		  if ($estado=='BAJA'){$valor='B';}
		  if ($estado=='IMPUESTO'){$valor='I';}
		  echo $total=$fila->Form_importe;
	   
	     echo $Numero_Int.'-'.$Numero_OP.'-'.$Beneficiario;
		 echo '<br>';
		 ///insertar en base Sigcom tabla op_pendiente
		 
	if ($t_fecha==$d_fecha)
	    {	 
		  $ssql = "SELECT * FROM `op_pendiente_tmp` WHERE Numero_OP='$Numero_OP' and Ejercicio='$Ejercicio' and Saf='$Saf'";
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
	     $ssql = "INSERT INTO `op_pendientes`
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
 
 ///////////////////actualizacion pendiente retncion
   
 /*    $ssql = "TRUNCATE TABLE `op_pendientes_r`";
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

   


 


   

