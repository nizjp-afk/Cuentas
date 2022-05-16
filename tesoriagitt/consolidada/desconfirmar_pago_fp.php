<?php
 error_reporting ( E_ERROR );
//conexion
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');

    $id = $_GET['id'];
	$fecha_cons=$_GET['consul'];
	
	
	
	
	 $ssql = "SELECT * FROM op_pendiente_tmp_fp where id='$id' ";
     if (!($r_op= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	 
	 $f_orden=mysql_fetch_array($r_op);
	$Clave=     $f_orden['Clave'];
	$Ejercicio=     $f_orden['Ejercicio'];
	$Fecha_OP =     $f_orden['Fecha_OP'];
	$Numero_OP =    $f_orden['Numero_OP'];
	$dato=split("-",$Numero_OP);
	$numero=$dato[2];
	$formulario=$dato[0];
	//$Numero_Int =   $f_orden['Numero_Int'];
	$Saf =          $f_orden['Saf'];
	$Fuente =       $f_orden['Fuente'];
    $Clase =        $f_orden['Clase'];
	$Beneficiario = $f_orden['Beneficiario'];
	$cuit_b = $f_orden['cuit'];
	$Concepto =     $f_orden['Concepto'];
	$IMP_FORM =     $f_orden['IMP_FORM'];
	$RETENCION=     $f_orden['RETENCION'];
	$IMP_DESAF =     $f_orden['IMP_DESAF'];
	$IMP_DESAF_RETEN =     $f_orden['IMP_DESAF_RETEN'];
    $IMPORTE_A_PAGAR =     $f_orden['IMPORTE_A_PAGAR'];
    $FECHA_INGRESO =     $f_orden['FECHA_INGRESO'];
    $HORA_INGRESO =     $f_orden['HORA_INGRESO'];
    $USUARIO =     $f_orden['USUARIO'];
    $id_escritural =     $f_orden['id_escritural'];
	$Imp_orden =    $f_orden['Imp_orden'];
	$Total_Pagado = $f_orden['Total_Pagado'];
	$Saldos =       $f_orden['Saldos'];
	$estado =   $f_orden['estado'];


   	///insertar en base Sigcom tabla op_pendiente_tmp
	include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php'); 
	 
	 
		  $ssql = "INSERT INTO `orden_pago_temp`
		  
		              ( `CLAVE` , `EJERCICIO` , `SAF` , `FECHA_OP` , `FORMULARIO` , `NUMERO` , `FUENTE` , `CLASE` , `CUIT` , `BENEFICIARIO` , `CONCEPTO` , `IMP_FORM` , `RETENCION` , `IMP_DESAF` , `IMP_DESAF_RETEN` , `IMPORTE_A_PAGAR` , `FECHA_INGRESO` , `HORA_INGRESO` , `USUARIO` , `id_escritural` ,ESTADO)
					  
				   VALUES ('$Clave','$Ejercicio' ,'$Saf', '$Fecha_OP' ,'$formulario','$numero','$Fuente' ,'$Clase' ,'$cuit_b' , '$Beneficiario', '$Concepto' ,'$IMP_FORM' , '$RETENCION' , '$IMP_DESAF' , '$IMP_DESAF_RETEN' , '$IMPORTE_A_PAGAR' , '$FECHA_INGRESO' , '$HORA_INGRESO' , '$USUARIO', '$id_escritural','$estado') ";
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
	
		include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	
			
		$ssql = "DELETE FROM op_pendiente_tmp_fp where id='$id' ";
     if (!($r_op= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
		
		?>						  
 <meta http-equiv='refresh' 
 content='0;url=indextesoreria.php?sec=consolidada/desconfirmar_orden_consolidada_fp&consul=<?php echo $fecha_cons; ?>&apli=h&per=A '/>	 </meta>              
       

