<?php
 error_reporting ( E_ERROR );
//conexion
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');

    $id = $_GET['id'];
	$saf = $_GET['saf'];
	$fecha_cons=$_GET['consul'];	
	
	/////traer el nro de ti
	
	$ssql = "SELECT * FROM control_ti_saf where numero='$saf'";
     if (!($r_cf= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
	$f_cf=mysql_fetch_array($r_cf);
	$nro =$f_cf['nro_ti'];
	
	
	////////
	 $ssql = "SELECT * FROM op_pendientes_fp where id='$id' ";
    
	 include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');
		 
    /////////////////////////////////////////////		 
	
	 $ssql = "SELECT * FROM orden_pago_temp_saf where CLAVE='$id' ";
     if (!($r_op= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	 
	 $f_orden=mysql_fetch_array($r_op);
	
	$Ejercicio=     $f_orden['EJERCICIO']; 
 	$Fecha_OP =     $f_orden['FECHA_OP']; 
	$formulario =   $f_orden['FORMULARIO'];
	$Saf =          $f_orden['SAF'];
	$Numero =       $f_orden['NUMERO'];
	$Fuente =       $f_orden['FUENTE'];
    $Clase =        $f_orden['CLASE'];
	$Beneficiario = $f_orden['BENEFICIARIO'];
	$cuit_b = $f_orden['CUIT'];
	$Concepto =     $f_orden['CONCEPTO'];
	$IMP_FORM =     $f_orden['IMP_FORM'];
	$RETENCION=     $f_orden['RETENCION'];
	$IMP_DESAF =     $f_orden['IMP_DESAF'];
	$IMP_DESAF_RETEN =     $f_orden['IMP_DESAF_RETEN'];
    $IMPORTE_A_PAGAR =     $f_orden['IMPORTE_A_PAGAR'];
    $FECHA_INGRESO =     $f_orden['FECHA_INGRESO'];
    $HORA_INGRESO =     $f_orden['HORA_INGRESO'];
    $USUARIO =     $f_orden['USUARIO'];
    $id_escritural =     $f_orden['id_escritural'];
	$Imp_orden =    $f_orden['IMP_FORM']-$f_orden['RETENCION'];
	$Total_Pagado = $f_orden['IMP_FORM']-$f_orden['RETENCION']-$f_orden['IMPORTE_A_PAGAR'];
	$Saldos =       $f_orden['IMPORTE_A_PAGAR'];
	$autorizado =   $f_orden['IMPORTE_A_PAGAR'];
	$estado =   $f_orden['ESTADO'];

/////////////////////////////

$Numero_OP =    $formulario.'-'.$Saf.'-'.$Numero;

////////////////////////////////
   	///insertar en base Sigcom tabla op_pendiente_tmp
   	///insertar en base Sigcom tabla op_pendiente_tmp
		 
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
		 
		  $ssql = "INSERT INTO `op_pendiente_tmp_fp`
		              ( Clave,`Ejercicio` , `Fecha_OP` , `Numero_OP` , `Numero_Int` , `Saf` , `Fuente` ,`Clase` , `Beneficiario` , `cuit` , `Concepto` ,`IMP_FORM` , `RETENCION` , `IMP_DESAF` , `IMP_DESAF_RETEN` , `IMPORTE_A_PAGAR` , `FECHA_INGRESO` , `HORA_INGRESO` , `USUARIO` , `id_escritural`, `Imp_orden` , `Total_Pagado` ,
					   `Saldos`,`autorizado`,`nro_ti`,`estado` )
				   VALUES ('$id','$Ejercicio' , '$Fecha_OP' , '$Numero_OP' , '$Numero_Int' , '$Saf' ,'$Fuente' ,'$Clase' , '$Beneficiario', '$cuit_b' , '$Concepto' ,'$IMP_FORM' , '$RETENCION' , '$IMP_DESAF' , '$IMP_DESAF_RETEN' , '$IMPORTE_A_PAGAR' , '$FECHA_INGRESO' , '$HORA_INGRESO' , '$USUARIO', '$id_escritural', '$Imp_orden' , '$Total_Pagado' ,'$Saldos','$autorizado','$nro','$estado') ";
				 
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
			
	 include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');
			
		$ssql = "DELETE FROM orden_pago_temp_saf where CLAVE='$id' ";
     if (!($r_op= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
		
	
		
		?>						  
 <meta http-equiv='refresh' 
 content='0;url=indextesoreria.php?sec=consolidada/cargar_orden_consolidada&consul=<?php echo $fecha_cons; ?>&apli=s&per=A&busnom=<?php echo $nom; ?> '/>	 </meta>              
       

