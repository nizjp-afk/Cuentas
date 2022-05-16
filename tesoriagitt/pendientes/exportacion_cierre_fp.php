<?php
//conexion
 error_reporting ( E_ERROR );  

	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
    $i=0;
	
	$ssql = "TRUNCATE TABLE `escritural`";
     if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "TRUNCATE TABLE `escritural";
      echo $cuerpo1;
      //.....................................................................
    } 	

	
	$ssql = "TRUNCATE TABLE `orden_pago_fp`";
     if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "TRUNCATE TABLE `orden_pago_fp";
      echo $cuerpo1;
      //.....................................................................
    }   
	
	 include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');
/*
if ($conn_access = odbc_connect ( "orden_pago_fp", "", ""))
{
  // echo "Conectado correctamente";
    $ssql = "SELECT [ORDEN DE PAGO].CLAVE_UNICA, [ORDEN DE PAGO].BENEFICIARIO, [ORDEN DE PAGO].NRO_DE_SAF, [ORDEN DE PAGO].TIPO_NUMERO, [ORDEN DE PAGO].CONCEPTO, [ORDEN DE PAGO].FORMULARIO, [ORDEN DE PAGO].RETENCION, [PAGOS DE CHEQUES].IMPORTE_DEL_CHEQUE, [PAGOS DE CHEQUES].FECHA_DE_PAGO, [ORDEN DE PAGO].EJERCICIO,[ORDEN DE PAGO].CLASE,[ORDEN DE PAGO].IMPORTE_DEL_FORMULARIO
FROM [ORDEN DE PAGO] INNER JOIN [PAGOS DE CHEQUES] ON [ORDEN DE PAGO].CLAVE_UNICA = [PAGOS DE CHEQUES].clave_Pagos
order by [PAGOS DE CHEQUES].FECHA_DE_PAGO;
";
    if($rs_access = odbc_exec ($conn_access, $ssql))
	 {
    //   echo "La sentencia se ejecutó correctamente";


*/


 
		 $ssql = "SELECT `orden_pago`.`CUIT`,`orden_pago`.`FUENTE`,`orden_pago`.`CLASE`,`orden_pago`.`CONCEPTO` ,`orden_pago`.`IMP_FORM` ,`pagos`. *
                  FROM `orden_pago` , pagos
                  WHERE `clave_OP` = CLAVE";
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			} 

 
include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
	

      while ($fila =  mysql_fetch_array($r_pago))
	   {
	     //echo 'paso';
		  $clave=$fila['clave_OP'];
		  
		  $clase=$fila['CLASE'];
		  
		   $fuente=$fila['FUENTE'];
		  
		  $cuit=$fila['CUIT'];
		 
		  $saf=$fila['SAF'];
		  
		  $formulario =   $fila['FORMULARIO'];
	      
		  $numero =       $fila['NUMERO'];
	
		  $orden_pago=$formulario.'-'.$saf.'-'.$numero;
		  
		  $concepto=$fila['CONCEPTO'];
		 
		  $importe=$fila['IMP_FORM'];
		  
		  $retencion=$fila['IMP_PAGO_RET'];
		  
		  $total=$fila['IMP_PAGO'];
		  
		  $liquido=$fila['IMP_PAGO'];
		  
		  $fecha=$fila['FECHA_DE_PAGO'];
		  
		   $fecha_i=$fila['FECHA_OP'];
		  
		  $ejercicio=$fila['Ejercicio'];
		  
		   $id_escritural=$fila['id_escritural'];
	      
		 
	     if(!($clase=='399'))
		   {
			
				
   		     $ssql = "INSERT INTO `orden_pago_fp` 
		        (`cuit` ,`saf`,`fuente`,`clase`,`orden_pago`,`fecha`,`concepto`,`importe`,`retencion`,
				 `ejercicio`,`total`,liquido,clave_escritural)
				VALUES ('$cuit','$saf','$fuente','$clase','$orden_pago','$fecha','$concepto','$importe',
						'$retencion','$ejercicio','$total','$liquido','$id_escritural') ";
				 if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar insertar pago tgp f p";
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

 include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');

	 $ssql = "SELECT `orden_pago`.`CUIT`,`orden_pago`.`FUENTE`,`orden_pago`.`CLASE`,`orden_pago`.`CONCEPTO` ,`orden_pago`.`IMP_FORM` ,`pagos`. *
                  FROM `orden_pago` , pagos
                  WHERE `clave_OP` = CLAVE
				  and orden_pago.id_escritural in ('158','159','160','161','162','163','164','165','166','167','168','169','170','171','172','173','174','175','176','177','178','179','180','181','182','183','184','185','186','187','188','189','190','191')";
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			} 

 
include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
	$ssql = "delete from `orden_pago` where ejercicio='2015'";
     if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar truncate";
      echo $cuerpo1;
      //.....................................................................
    } 

      while ($fila =  mysql_fetch_array($r_pago))
	   {
	     //echo 'paso';
		  $clave=$fila['clave_OP'];
		  
		  $clase=$fila['CLASE'];
		  
		   $fuente=$fila['FUENTE'];
		  
		  $cuit=$fila['CUIT'];
		 
		  $saf=$fila['SAF'];
		  
		  $formulario =   $fila['FORMULARIO'];
	      
		  $numero =       $fila['NUMERO'];
	
		  $orden_pago=$formulario.'-'.$saf.'-'.$numero;
		  
		  $concepto=$fila['CONCEPTO'];
		 
		  $importe=$fila['IMP_FORM'];
		  
		  $retencion=$fila['IMP_PAGO_RET'];
		  
		  $total=$fila['IMP_PAGO'];
		  
		  $liquido=$fila['IMP_PAGO'];
		  
		  $fecha=$fila['FECHA_DE_PAGO'];
		  
		   $fecha_i=$fila['FECHA_OP'];
		  
		  $ejercicio=$fila['Ejercicio'];
		  
		   $id_escritural=$fila['id_escritural'];
	      
		 
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

 include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');
 
 $ssql = "SELECT *
                  FROM `orden_pago` 
                  WHERE estado !='C'
				  and fuente < '12'";
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			} 

 
include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');

$ssql = "delete from `op_pendientes` where ejercicio='2015'";
     if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar truncate";
      echo $cuerpo1;
      //.....................................................................
    } 

      while ($fila =  mysql_fetch_array($r_pago))
	   {
	     //echo 'paso';
		  $clave=$fila['clave_OP'];
		  
		  $clase=$fila['CLASE'];
		  
		   $fuente=$fila['FUENTE'];
		  
		  $cuit=$fila['CUIT'];
		 
		  $saf=$fila['SAF'];
		   $BENEFICIARIO=$fila['BENEFICIARIO'];
		  
		  $formulario =   $fila['FORMULARIO'];
	      
		  $numero =       $fila['NUMERO'];
	
		    $orden_pago=$formulario.'-'.$saf.'-'.$numero;
		  
		  $concepto=$fila['CONCEPTO'];
		 
		  $importe=$fila['IMP_FORM'];
		  
		  $retencion=$fila['IMP_PAGO_RET'];
		  
		  $total=$fila['IMP_PAGO'];
		  
		  $Total_Pagado=$fila['IMPORTE_A_PAGAR'];
		  
		  $Saldos=$importe-$Total_Pagado;
		  
		  $fecha=$fila['FECHA_DE_PAGO'];
		  
		   $fecha_i=$fila['FECHA_OP'];
		  
		  $ejercicio=$fila['Ejercicio'];
		  
		   $valor=$fila['ESTADO'];
		   
		   $TOTA_A_P=$importe-$retencion;
		   
	      
		  
		   $ssql = "INSERT INTO `op_pendientes`
		              ( `Ejercicio` , `Fecha_OP` , `Numero_OP` ,  `Saf` , `Fuente` ,
					   `Clase` , `Beneficiario` , `Concepto` , `Imp_orden` , `Total_Pagado` ,
					   `Saldos`,`cuit`,estado,total_orden)
				   VALUES ('$ejercicio' , '$fecha_i' , '$orden_pago' , '$saf' , 
						   '$fuente' ,'$clase' , '$BENEFICIARIO' , '$Concepto' , '$TOTA_A_P' ,
						   '$Total_Pagado','$Saldos','$cuit','$valor','$importe'); ";
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
		 

/*




///////////escritural
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
    $i=0;
	
	$f=strftime("%Y-%m-%d");
///////////escritural
$ssql = "TRUNCATE TABLE `escritural`";
     if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    } 	


/*
	
if ($conn_access = odbc_connect ( "orden_pago_fp", "", ""))
{
  // echo "Conectado correctamente";
    $ssql = "SELECT Cta_Escritural.id_cod, Cta_Escritural.CTA_ESCRITURAL, Cta_Escritural.TE_CUENTO,Cta_Escritural.NUM_CUENTA, Cta_Escritural.DESCIP, Cta_Escritural.FECHA, Cta_Escritural.PERIODO, Cta_Escritural.detalle1, Cta_Escritural.detalle2, Cta_Escritural.DEBITO, Cta_Escritural.RETENC, Cta_Escritural.CREDITO, Cta_Escritural.FECHA_ACT
FROM Cta_Escritural
ORDER BY Cta_Escritural.id_cod;";
    if($rs_access = odbc_exec ($conn_access, $ssql))
	 {
    //   echo "La sentencia se ejecutó correctamente";
       while ($fila = odbc_fetch_object($rs_access))
	   {
	     //echo 'paso';
		  $cod_proceso=$fila->id_cod;
		  $esc_cuenta=$fila->CTA_ESCRITURAL;
		  $dato=split("-",$esc_cuenta);
		  $num_cuenta=$fila->NUM_CUENTA;
		  echo $nro_bco=substr($num_cuenta,0,3);
		  $cta_pagadora=$fila->TE_CUENTO;
		  $descri=$fila->DESCIP;
		  $fecha=$fila->FECHA;
		  $periodo=$fila->PERIODO;
		  $detalle_1=$fila->detalle1;
		  $detalle_2=$fila->detalle2;
		  $debito=$fila->DEBITO;
		  $retenciones=$fila->RETENC;
		  $credito=$fila->CREDITO;
		  $fecha_act=$fila->FECHA_ACT;
		  $saf1=$dato[0];
		  $saf2=$dato[1];
	       $descripcion=trim($descri);
	     echo $saf1.'  '.$saf2;
		 echo '<br>';
		  echo '<br>';
		 ///insertar en base Sigcom tabla op_pendiente


*/



 include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');

 $ssql = "SELECT * from escritural ";
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "consulta para armar escritural1";
			  echo $cuerpo1;
			  //.....................................................................
			} 

 
include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');

 while ($fila =  mysql_fetch_array($r_pago))
	   {
          $cod_proceso=1;
		  $esc_cuenta=$fila['ESCRITURAL'];
		   $esc_deno=$fila['DENOMINACION'];
		  $saf=$fila['SAF'];
		  $periodo='TRANSPORTE';
		  $fecha_act=$fila['FECHA_ACT'];
		   $IMPORTE_inicial=$fila['IMPORTE_SALDO'];
		 
	     $ssql = "INSERT INTO `escritural`
		              ( `cod_proceso` , `saf`, `esc_cuenta`,fecha_act,nombre_esc,credito)
				   VALUES ('$cod_proceso' ,'$saf','$esc_cuenta','$f','$esc_deno','$IMPORTE_inicial' )";
				 if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar insertar escritural1";
				  echo $cuerpo1;
				  echo $orden_pago;
				   echo $ejercicio;
				  //.....................................................................
				} 
	   
	 
	 }
	 
	
   /*
     $cod_proceso=1;
		  $esc_cuenta=$fila['ESCRITURAL'];
		  $dato=split("-",$esc_cuenta);
		  $num_cuenta=$fila['NUM_CUENTA'];
		  echo $nro_bco=substr($num_cuenta,0,3);
		  $cta_pagadora=$fila['TE_CUENTO'];
		  $descri=$fila['DESCIP'];
		  $fecha=$fila['FECHA'];
		  $periodo=$fila['PERIODO'];
		  $detalle_1=$fila['detalle1'];
		  $detalle_2=$fila['detalle2'];
		  $debito=$fila['DEBITO'];
		  $retenciones=$fila['RETENC'];
		  $credito=$fila['CREDITO'];
		  $fecha_act=$fila['FECHA_ACT'];
		  $saf1=$dato[0];
		  $saf2=$dato[1];
	       $descripcion=trim($descri);
	     echo $saf1.'  '.$saf2;*/

	
	
	
	 include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');

 $ssql = "SELECT CONCAT(a.AUXILIAR_COD,' ', a.CONCEPTO) AS descripcion, c.ID, c.CUENTA AS num_cuenta, c.CUENTA AS periodo, c.denominacion AS detalle1, m.id_Escritural, m.id_Corriente,m.Movimiento as detalle2, m.Tipo, m.Imp_Bruto as credito,m.Imp_Debito as debito,m.Imp_Reten as retencion,m.Fec_Extracto as fecha, e.ID, e.ESCRITURAL AS esc_cuenta, e.SAF AS saf
FROM auxiliar_ingresos AS a, cuentas_corrientes AS c, mov_ingresos AS m, escritural AS e
WHERE a.AUXILIAR_COD = m.Tipo
AND c.ID = m.id_Corriente
AND m.id_Escritural = e.ID
";
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "consulta para armar escritural2";
			  echo $cuerpo1;
			  //.....................................................................
			} 

 
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');

 while ($fila =  mysql_fetch_array($r_pago))
	   {
          $cod_proceso=2;
		  
		  $saf1=$fila['saf'];
		  
		  $esc_cuenta=$fila['esc_cuenta'];
		  
		  $num_cuenta=$fila['num_cuenta'];
		  
		  $nro_bco=substr($num_cuenta,0,3);
		  
		  $periodo=$fila['periodo'];
		  
		  $descripcion=$fila['descripcion'];
		  
		  $fecha=$fila['fecha'];
		  
		  $detalle1=$fila['detalle1'];
		  
		   $detalle2=$fila['detalle2'];
		  
		  $credito=$fila['credito'];
		  
		  $debito=$fila['debito'];
		  
		  $retenciones=$fila['retencion'];
		  
		 // $periodo='TRANSPORTE';
		  
		  $fecha_act=$fila['FECHA_ACT'];
		 
	     $ssql = "INSERT INTO `escritural`
		              ( `cod_proceso` , `saf`, `esc_cuenta`, `bco_pagador` ,`nro_bco`,`num_cuenta` , `descripcion` , `fecha` , `periodo` , `detalle_1` , `detalle_2` , `debito` , `retenciones` , `credito` , `fecha_act` )
				   VALUES ('$cod_proceso' ,'$saf1', '$esc_cuenta','$cta_pagadora' ,'$nro_bco', '$num_cuenta' , '$descripcion' , '$fecha' , '$periodo' , '$detalle1' , '$detalle2' , '$debito' , '$retenciones' , '$credito' , '$fecha_act' ); ";
				 if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar insertar escritual2";
				  echo $cuerpo1;
				  echo $esc_cuenta;
				   echo $cta_pagadora;
				    echo $saf1;
					echo $descripcion;
					
				  //.....................................................................
				} 
	   
	 
	 }
	
 /////////////////////egreso......
 
 
 
 
 
  include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');

 $ssql = "SELECT p.SAF,p.Ejercicio,p.id_escritural,p.IMP_PAGO,p.IMP_PAGO_RET,p.CBU_DES,p.TIPO_PAGO,p.NUM_PAGO,p.FORMULARIO,p.NUMERO,p.FECHA_DE_PAGO as fecha,o.FUENTE,o.BENEFICIARIO,o.CONCEPTO,e.ESCRITURAL AS esc_cuenta
FROM pagos as p, orden_pago as o,escritural AS e
WHERE CLAVE=clave_OP
AND p.ESTADO='Confirmado'
AND p.id_escritural = e.ID
";
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "consulta para armar escritural3";
			  echo $cuerpo1;
			  //.....................................................................
			} 

 
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');

 while ($fila =  mysql_fetch_array($r_pago))
	   {
          $cod_proceso=3;
		  
		  $saf1=$fila['SAF'];
		  
		  $esc_cuenta=$fila['esc_cuenta'];
		  
		  $num_cuenta=$fila['CBU_DES'];
		  
		  $num_cuenta=substr($num_cuenta,12,-1);
		  
		  $nro_bco=substr($num_cuenta,0,3);
		  
		  $cta_pagadora=substr($num_cuenta,0,2);
		  
		  $periodo=$fila['periodo'];
		  
		  $descripcion=$fila['FUENTE'].'-'.$fila['TIPO_PAGO'].'-'.$fila['NUM_PAGO'].'-'.$fila['FORMULARIO'].'-'.$fila['SAF'].'-'.$fila['NUMERO'].'-'.$fila['Ejercicio'];
		  
		  $fecha=$fila['fecha'];
		  
		  $detalle1=$fila['BENEFICIARIO'];
		  $detalle2=$fila['CONCEPTO'];
		  
		  $debito=$fila['IMP_PAGO'];
		  
		  $retenciones=$fila['IMP_PAGO_RET'];
		  
		 // $periodo='TRANSPORTE';
		  
		  $fecha_act=$fila['FECHA_ACT'];
		  
		  
		  $orden =$fila['FORMULARIO'].'-'.$fila['SAF'].'-'.$fila['NUMERO'];
		  
		 
	     $ssql = "INSERT INTO `escritural`
		              ( `cod_proceso` , `saf`, `esc_cuenta`, `bco_pagador` ,`nro_bco`,`num_cuenta` , `descripcion` , `fecha` , `periodo` , `detalle_1` , `detalle_2` , `debito` , `retenciones` ,  `fecha_act`,  `orden` )
				   VALUES ('$cod_proceso' ,'$saf1', '$esc_cuenta','$cta_pagadora' ,'$nro_bco', '$num_cuenta' , '$descripcion' , '$fecha' , '$periodo' , '$detalle1' , '$detalle2' , '$debito' , '$retenciones' ,  '$fecha_act',  '$orden' ); ";
				 if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar insertar escritural3";
				  echo $cuerpo1;
				  echo $descripcion;
				   echo $ejercicio;
				  //.....................................................................
				} 
	   
	 
	 }
	
 ////proceso del 702 formulario 45
 /*
 
  include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');

 $ssql = "SELECT p.SAF, p.id_escritural, p.IMP_PAGO, p.IMP_PAGO_RET, p.CBU_DES, p.TIPO_PAGO, p.NUM_PAGO, p.FORMULARIO, p.NUMERO, p.FECHA_DE_PAGO AS fecha, e.ESCRITURAL AS esc_cuenta
FROM pagos AS p, escritural AS e
WHERE p.ESTADO = 'Confirmado'
AND p.id_escritural = e.ID
AND e.ESTADO = 'A'
AND p.`id_escritural` =4
AND p.`FORMULARIO` =45
ORDER BY p.`FORMULARIO` , p.`NUMERO` ASC";
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "consulta para armar escritural4";
			  echo $cuerpo1;
			  //.....................................................................
			} 

 
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');

 while ($fila =  mysql_fetch_array($r_pago))
	   {
          $cod_proceso=3;
		  
		  $saf1=$fila['SAF'];
		  
		  $esc_cuenta=$fila['esc_cuenta'];
		  
		  $num_cuenta=$fila['CBU_DES'];
		  
		  $num_cuenta=substr($num_cuenta,12,-1);
		  
		  $nro_bco=substr($num_cuenta,0,3);
		  
		  $cta_pagadora=substr($num_cuenta,0,2);
		  
		  $periodo=$fila['periodo'];
		  
		  $descripcion=$fila['FUENTE'].' - '.$fila['TIPO_PAGO'].'-'.$fila['NUM_PAGO'].'-'.$fila['FORMULARIO'].'-'.$fila['SAF'].'-'.$fila['NUMERO'];
		  
		  $fecha=$fila['fecha'];
		  
		  $detalle1=$fila['BENEFICIARIO'];
		  $detalle2=$fila['CONCEPTO'];
		  
		  $debito=$fila['IMP_PAGO'];
		  
		  $retenciones=$fila['IMP_PAGO_RET'];
		  
		 // $periodo='TRANSPORTE';
		  
		  $fecha_act=$fila['FECHA_ACT'];
		 
	     $ssql = "INSERT INTO `escritural`
		              ( `cod_proceso` , `saf`, `esc_cuenta`, `bco_pagador` ,`nro_bco`,`num_cuenta` , `descripcion` , `fecha` , `periodo` , `detalle_1` , `detalle_2` , `debito` , `retenciones` ,  `fecha_act` )
				   VALUES ('$cod_proceso' ,'$saf1', '$esc_cuenta','$cta_pagadora' ,'$nro_bco', '$num_cuenta' , '$descripcion' , '$fecha' , '$periodo' , '$detalle1' , '$detalle2' , '$debito' , '$retenciones' ,  '$fecha_act' ); ";
				 if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar insertar escritural4";
				  echo $cuerpo1;
				  echo $orden_pago;
				   echo $ejercicio;
				  //.....................................................................
				} 
	   
	 
	 }
	
 
 */
     include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');
	 
 
 $ssql = "TRUNCATE TABLE `orden_pago_temp`";
     if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "tuncate orden_temp";
      echo $cuerpo1;
      //.....................................................................
    } 
	
	$ssql = "TRUNCATE TABLE `orden_pago_temp_saf`";
     if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "tuncate orden_temp_saf";
      echo $cuerpo1;
      //.....................................................................
    } 
 
  ;
 $ssql = "INSERT INTO `dbtgp`.`orden_pago_temp`
SELECT *
FROM `dbtgp`.`orden_pago`";
     if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar insertar pendiente";
      echo $cuerpo1;
      //.....................................................................
    } 
 
  $ssql = "INSERT INTO `dbtgp`.`orden_pago_temp_saf`
SELECT *
FROM `dbtgp`.`orden_pago`";
     if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar insertar pendiente1";
      echo $cuerpo1;
      //.....................................................................
    } 
 
  $ssql = "update `estado_tei` set estado='C' ";
     if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
	 include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');
	
	 $ssql = "SELECT * from escritural ";
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "consulta para armar escritural1";
			  echo $cuerpo1;
			  //.....................................................................
			} 
			
		  $ssql = "SELECT * from cuentas_corrientes ";
				  
     	 if (!($r_cta= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "consulta para armar escritural1";
			  echo $cuerpo1;
			  //.....................................................................
			} 	
			
		 while ($fila =  mysql_fetch_array($r_pago))
	   {
          
		  
		  $id=$fila['ID'];
		  
		    include('dgti-mysql-var_dgti-beneficiarios.php');
			include('dgti-intranet-mysql_connect.php');  
			include('dgti-intranet-mysql_select_db.php');
			include('conexion/extras.php');
			
			
			$ssql = "SELECT * from saf_escritural where ID='$id'";
			 if (!($r_esc= mysql_query($ssql, $conexion_mysql)))
			{
			
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "select `escritural";
			  echo $cuerpo1;
			  //.....................................................................
			} 	 
			$cant=mysql_num_rows($r_esc);
			if (empty($cant))  
			  {
				  
			
				$SAF=$fila['SAF'];
				$ESCRITURAL=$fila['ESCRITURAL'];
				$DENOMINACION=$fila['DENOMINACION'];
				$IMPORTE_SALDO=$fila['IMPORTE_SALDO'];
				$ESTADO=$fila['ESTADO'];
				$GRUPO=$fila['GRUPO'];
				$orden=$fila['orden'];
				$bandera=$fila['bandera'];
				
				
				$sql = "INSERT INTO saf_escritural (`ID`, `SAF`, `ENTIDAD`, `ESCRITURAL`, `DENOMINACION`, `IMPORTE_SALDO`, `ESTADO`, `GRUPO`, `orden`,`bandera`)
				 VALUES ('$id', '$SAF', '$ENTIDAD', '$ESCRITURAL', '$DENOMINACION', '$IMPORTE_SALDO', '$ESTADO', '$GRUPO', '$orden','$bandera')" ;
						 if (!($r_pre_m= mysql_query($sql, $conexion_mysql)))
						{
						  //.....................................................................
						  // informa del error producido
						  $cuerpo1  = "al intentar buscar decretos";
						  //.....................................................................
						}
				 
				
			  }
			 else
			 {
				 $ESTADO=$fila['ESTADO'];
				  $sql = "update saf_escritural SET ESTADO='$ESTADO' where ID='$id'" ;
						 if (!($r_pre_m= mysql_query($sql, $conexion_mysql)))
						{
						  //.....................................................................
						  // informa del error producido
						  $cuerpo1  = "al intentar buscar decretos";
						  //.....................................................................
						}
			 }
	   }

		 while ($cuenta =  mysql_fetch_array($r_cta))
	   {
          
		  
		  $id_c=$cuenta['ID'];
		  
		    include('dgti-mysql-var_dgti-beneficiarios.php');
			include('dgti-intranet-mysql_connect.php');  
			include('dgti-intranet-mysql_select_db.php');
			
			
			
			$ssql = "SELECT * from cuentas_corrientes where ID='$id_c'";
			 if (!($r_cc= mysql_query($ssql, $conexion_mysql)))
			{
			
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "select `escritural";
			  echo $cuerpo1;
			  //.....................................................................
			} 	 
			$cant_c=mysql_num_rows($r_cc);
			if (empty($cant_c))  
			  {
				  
			
				$CUENTA=$cuenta['CUENTA'];
				$BANCO=$cuenta['BANCO'];
				$BANCO_ABREV=$cuenta['BANCO_ABREV'];
				$DENOMINACION=$cuenta['denominacion'];
				$MONEDA=$cuenta['MONEDA'];
				$ESTADO=$cuenta['ESTADO'];
				$AFECTADA=$cuenta['AFECTADA'];
				
				
				
				$sql = "INSERT INTO cuentas_corrientes (`ID`, `CUENTA`, `BANCO`, `BANCO_ABREV`, `denominacion`, `MONEDA`, `ESTADO`, `AFECTADA`)
				 VALUES ('$id_c', '$CUENTA', '$BANCO', '$BANCO_ABREV', '$DENOMINACION', '$MONEDA', '$ESTADO', '$AFECTADA')" ;
						 if (!($r_pre_m= mysql_query($sql, $conexion_mysql)))
						{
						  //.....................................................................
						  // informa del error producido
						  $cuerpo1  = "al intentar buscar decretos";
						  //.....................................................................
						}
				 
				
			  }
			 else
			 {
				 $ESTADO=$cuenta['ESTADO'];
				  $sql = "update cuentas_corrientes SET ESTADO='$ESTADO' where ID='$id_c'" ;
						 if (!($r_pre_m= mysql_query($sql, $conexion_mysql)))
						{
						  //.....................................................................
						  // informa del error producido
						  $cuerpo1  = "al intentar buscar decretos";
						  //.....................................................................
						}
			 }
	   }
	
	
	
	
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
   

$ssql = "delete from `op_pendientes` where ejercicio='2015'";
     if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar truncate";
      echo $cuerpo1;
      //.....................................................................
    } 
	
   include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');

 
 $ssql = "SELECT *
                  FROM `orden_pago` 
                  WHERE estado !='C'
				   and orden_pago.id_escritural in ('158','159','160','161','162','163','164','165','166','167','168','169','170','171','172','173','174','175','176','177','178','179','180','181','182','183','184','185','186','187','188','189','190','191')";
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			} 

 
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    


      while ($fila =  mysql_fetch_array($r_pago))
	   {
	     //echo 'paso';
		echo  $clave=$fila['clave_OP'];
		  
		  $clase=$fila['CLASE'];
		  
		   $fuente=$fila['FUENTE'];
		  
		  $d_cuit=$fila['CUIT'];
		 
		  $saf=$fila['SAF'];
		  
		   $Beneficiario=$fila['BENEFICIARIO'];
		  
		  $formulario =   $fila['FORMULARIO'];
	      
		  $numero =       $fila['NUMERO'];
	
		 echo   $orden_pago=$formulario.'-'.$saf.'-'.$numero;
		  
		  $concepto=$fila['CONCEPTO'];
		 
		  $importe=$fila['IMP_FORM'];
		  
		  $retencion=$fila['IMP_PAGO_RET'];
		  
		  
		   $Numero_Int='';
		  $total=$fila['IMP_PAGO'];
		  
		
		  
		 
		  
		  $fecha=$fila['FECHA_DE_PAGO'];
		  
		   $fecha_i=$fila['FECHA_OP'];
		  
		 echo $ejercicio=$fila['EJERCICIO'];
		  
		   $valor=$fila['ESTADO'];
		   
		     if ($valor=='P'){$valor='N';}
		  if ($valor=='B'){$valor='R';}
		  if ($valor=='A'){$valor='B';}
		  if ($valor=='I'){$valor='I';}
		   
		   $Imp_orden=$importe-$retencion;
		   
		   
		    $Saldos=$fila['IMPORTE_A_PAGAR'];
			
			
			  $Total_Pagado=$Imp_orden-$Saldos;
		   echo '<br>';
	      
		  
		   $ssql = "INSERT INTO `op_pendientes`
											  ( `Ejercicio` , `Fecha_OP` , `Numero_OP` , `Numero_Int` , `Saf` , `Fuente` ,
											   `Clase` , `Beneficiario` , `Concepto` , `Imp_orden` , `Total_Pagado` ,
											   `Saldos`,`cuit`,estado,total_orden)
										   VALUES ('$ejercicio' , '$fecha_i' , '$orden_pago' , '$Numero_Int' , '$saf' , 
												   '$fuente' ,'$clase' , '$Beneficiario' , '$concepto' , '$Imp_orden' ,
												   '$Total_Pagado' ,'$Saldos','$d_cuit','$valor','$importe'); ";
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
		
?>

   


   

