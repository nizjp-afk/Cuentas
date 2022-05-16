<?php
//conexion
 error_reporting ( E_ERROR );  

	
    $i=0;
	
	


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

 $ssql = "SELECT CONCAT(a.AUXILIAR_COD,' ', a.CONCEPTO) AS descripcion, c.ID, c.CUENTA AS num_cuenta, c.CUENTA AS periodo, c.denominacion AS detalle1, m.id_Escritural, m.id_Corriente,m.Movimiento as detalle2,  TRIM( m.Tipo ) as TIPO , m.Imp_Bruto as credito,m.Imp_Debito as debito,m.Imp_Reten as retencion,m.Fec_Extracto as fecha, e.ID, e.ESCRITURAL AS esc_cuenta, e.SAF AS saf
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
		  
		  $fecha_e=$fila['fecha'];
		  
		  $detalle1=$fila['detalle1'];
		  
		   $detalle2=$fila['detalle2'];
		  
		  $credito=$fila['credito'];
		  
		  $debito=$fila['debito'];
		  
		  $retenciones=$fila['retencion'];
		  
		  
		   $tipo_m=trim($fila['TIPO']);
		   
		   $tipo_v='8-60-4';
		  
		 // $periodo='TRANSPORTE';
		  
		  $fecha_act=$fila['FECHA_ACT'];
		  
		  $fecha_t='2015-04-21';
		  
		/*
				
				if($fecha_t > $fecha_e)
				 {
			
	     $ssql = "INSERT INTO `escritural`
		              ( `cod_proceso` , `saf`, `esc_cuenta`, `bco_pagador` ,`nro_bco`,`num_cuenta` , `descripcion` , `fecha` , `periodo` , `detalle_1` , `detalle_2` , `debito` , `retenciones` , `credito` , `fecha_act` )
				   VALUES ('$cod_proceso' ,'$saf1', '$esc_cuenta','$cta_pagadora' ,'$nro_bco', '$num_cuenta' , '$descripcion' , '$fecha_e' , '$periodo' , '$detalle1' , '$detalle2' , '$debito' , '$retenciones' , '$credito' , '$fecha_act' ); ";
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
			*/
	
		   
		   
		   
	   		
	 
	 
	 
	 $ssql = "INSERT INTO `escritural`
		              ( `cod_proceso` , `saf`, `esc_cuenta`, `bco_pagador` ,`nro_bco`,`num_cuenta` , `descripcion` , `fecha` , `periodo` , `detalle_1` , `detalle_2` , `debito` , `retenciones` , `credito` , `fecha_act`,tipo )
				   VALUES ('$cod_proceso' ,'$saf1', '$esc_cuenta','$cta_pagadora' ,'$nro_bco', '$num_cuenta' , '$descripcion' , '$fecha_e' , '$periodo' , '$detalle1' , '$detalle2' , '$debito' , '$retenciones' , '$credito' , '$fecha_act','$tipo_m' ); ";
				 if (!($r_orden_p= mysql_query($ssql, $conexion_mysql)))
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
	 
	$ssql_d = "DELETE FROM  `escritural` WHERE  `tipo` = '8-60-4' AND  `fecha` >  '2015-04-20'";
				  
     	 if (!($r_delete = mysql_query($ssql_d, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "consulta para armar escritural1";
			  echo $cuerpo1;
			  //.....................................................................
			} 	
			
			$ssql = "INSERT INTO `escritural` ( `cod_proceso`, `saf`, `esc_cuenta`, `nombre_esc`, `nro_bco`, `bco_pagador`, `num_cuenta`, `descripcion`, `fecha`, `periodo`, `detalle_1`, `detalle_2`, `debito`, `retenciones`, `credito`, `fecha_act`, `orden`, `tipo`) VALUES
(2, '701', '011-325-3250044747', '', '325', '', '3250044747', '8-01-6 ING. POR AJUSTE', '2016-09-29', '3250044747', 'Fondo Programa Federal Plurianual de Vivienda', 'AJUSTE POR ERROR DE DUPLICIDAD EN RETENCIONES DIA 10/06/2016 OP Nº 10109', '0.00', '0.00', '100617.92', '0000-00-00', '', '8-01-6');
 ";
				 if (!($r_orden_p= mysql_query($ssql, $conexion_mysql)))
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
 /////////////////////egreso......
 

 
 
 
  include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');

 $ssql = "SELECT p.SAF,p.Ejercicio,p.id_escritural,p.IMP_PAGO,p.IMP_PAGO_RET,p.CBU_DES,p.TIPO_PAGO,p.NUM_PAGO,p.FORMULARIO,p.NUMERO,p.FECHA_DE_PAGO as fecha,o.FUENTE,o.BENEFICIARIO,o.CONCEPTO,e.ESCRITURAL AS esc_cuenta
FROM pagos_web as p, orden_pago as o,escritural AS e
WHERE CLAVE=clave_OP
AND p.ESTADO='Confirmado'
AND p.id_escritural = e.ID
and p.FECHA_DE_PAGO <'2016-10-01'
";
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "consulta para armar escritural";
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
				  $cuerpo1  = "al intentar insertar escritural";
				  echo $cuerpo1;
				  echo $descripcion;
				   echo $ejercicio;
				  //.....................................................................
				} 
	   
	 
	 }
	

$ssql = "delete FROM `escritural` WHERE `tipo`='8-01-6' and `saf`='701' and (`fecha` > '2015-04-21' AND `fecha` < '2016-09-29')";
  if (!($r_orden_a= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar insertar escritural 701 8016";
				  echo $cuerpo1;
				  echo $descripcion;
				   echo $ejercicio;
				  //.....................................................................
				}
$ssql = "delete FROM `escritural` WHERE `tipo`='8-01-6' and `saf`='702' and `fecha` > '2015-04-21'";
  if (!($r_orden_a= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar insertar escritural 702 80106";
				  echo $cuerpo1;
				  echo $descripcion;
				   echo $ejercicio;
				  //.....................................................................
				}
				

$ssql = "delete FROM `escritural` WHERE `tipo`='8-01-1' and `saf`='702' and `fecha` = '2016-05-03'";
  if (!($r_orden_a= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar insertar escritural 702 80106";
				  echo $cuerpo1;
				  echo $descripcion;
				   echo $ejercicio;
				  //.....................................................................
				}
$ssql = "delete FROM `escritural` WHERE `tipo`='8-01-6' and `saf`='501' and `fecha` = '2015-11-18'";
  if (!($r_orden_a= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar insertar escritural 702 80106";
				  echo $cuerpo1;
				  echo $descripcion;
				   echo $ejercicio;
				  //.....................................................................
				}				
				


$ssql = "delete FROM `escritural` WHERE `tipo`='8-60-6' and `fecha` = '2015-12-30' ";
  if (!($r_orden_a= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar insertar escritural 8606";
				  echo $cuerpo1;
				  echo $descripcion;
				   echo $ejercicio;
				  //.....................................................................
				}	
				
$ssql = "delete FROM `escritural` WHERE `tipo`='8-60-6' and `fecha` = '2015-02-23' and `saf`='250'";
  if (!($r_orden_a= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar insertar escritural 250 8606";
				  echo $cuerpo1;
				  echo $descripcion;
				   echo $ejercicio;
				  //.....................................................................
				}								


$ssql = "delete FROM `escritural` WHERE `tipo`='8-01-6' and `saf`='420' and (`fecha` > '2015-04-21' and `fecha` < '2016-02-23')";
  if (!($r_orden_a= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar insertar escritural 420 8016";
				  echo $cuerpo1;
				  echo $descripcion;
				   echo $ejercicio;
				  //.....................................................................
				}
$ssql = "delete FROM `escritural` WHERE `tipo`='8-01-6' and `saf`='420' and `fecha` >  '2016-02-23'";
  if (!($r_orden_a= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar insertar escritural 420 8016";
				  echo $cuerpo1;
				  echo $descripcion;
				   echo $ejercicio;
				  //.....................................................................
				}				
				/*$ssql = "delete FROM `escritural` WHERE `tipo`='8-01-1' and `saf`='420' and `fecha` = '2016-04-11'";
  if (!($r_orden_a= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar insertar escritural420";
				  echo $cuerpo1;
				  echo $descripcion;
				   echo $ejercicio;
				  //.....................................................................
				}*/
$ssql = "delete FROM `escritural` WHERE `tipo`='8-60-6' and `saf`='250' and `fecha`= '2016-02-23'";
  if (!($r_orden_a= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar insertar escritural250";
				  echo $cuerpo1;
				  echo $descripcion;
				   echo $ejercicio;
				  //.....................................................................
				}
$ssql = "update `escritural` set fecha='2016-09-27',detalle_2='Ajuste DESAF DE OP.742/15 DE FECHA 29/12/2015' WHERE `tipo`='8-60-6' and `saf`='701' and `fecha`= '2016-04-22' and periodo='3250032722'";
  if (!($r_orden_a= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar insertar escritural701 722";
				  echo $cuerpo1;
				  echo $descripcion;
				   echo $ejercicio;
				  //.....................................................................
				}	
				

$ssql = "update `escritural` set fecha='2016-09-27',detalle_2='Ajuste DESAF DE OP.742/15 DE FECHA 29/12/2015' WHERE `tipo`='8-60-6' and `saf`='701' and `fecha`= '2016-04-22' and periodo='3250032722'";
  if (!($r_orden_a= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar insertar escritural701 722";
				  echo $cuerpo1;
				  echo $descripcion;
				   echo $ejercicio;
				  //.....................................................................
				}
											

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
	
	
	
	
	
?>

   


   

