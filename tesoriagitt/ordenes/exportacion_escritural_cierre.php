<?php
//conexion
 error_reporting ( E_ERROR );  

	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
    $i=0;
	
	
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
		 
	     $ssql = "INSERT INTO `escritural`
		              ( `cod_proceso` , `saf`, `esc_cuenta`, `bco_pagador` ,`nro_bco`,`num_cuenta` , `descripcion` , `fecha` , `periodo` , `detalle_1` , `detalle_2` , `debito` , `retenciones` , `credito` , `fecha_act` )
				   VALUES ('$cod_proceso' ,'$saf1', '$esc_cuenta','$cta_pagadora' ,'$nro_bco', '$num_cuenta' , '$descripcion' , '$fecha' , '$periodo' , '$detalle_1' , '$detalle_2' , '$debito' , '$retenciones' , '$credito' , '$fecha_act' ); ";
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
   

	
 
?>

   

