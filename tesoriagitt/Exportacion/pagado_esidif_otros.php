<?
//error_reporting ( E_ERROR );
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
    $archivo = file("pagado_esidif_otros.txt");
  echo  $cuantos = count($archivo);
	
    for ($var=0;$var<$cuantos;$var++)
	{
				
	    $linea=  explode("\t",$archivo[$var]);
		echo $lote= trim($linea[11]);echo "<br>";
	
		
	    echo $beneficiario= trim($linea[0]);echo "<br>";
		echo $saf= trim($linea[1]);echo "<br>";
		echo $fuente= trim($linea[2]);echo "<br>";
		echo $clase= trim($linea[3]);echo "<br>";
		 $tipo= trim($linea[4]);echo "<br>";
		if(($tipo =='C41') or ($tipo=='C42'))
		  {
			$tipo=substr($tipo,1,3);   
		  }
		 
		 $nro_op= trim($linea[5]);
		echo $orden_pago=$tipo.'-'.$saf.'-'.$nro_op;echo "<br>";
		echo $fecha_p= trim($linea[6]);echo "<br>";
		
		$fecha_pp=split("/",$fecha_p);
	 	echo $fecha=$fecha_pp[2].'-'.$fecha_pp[1].'-'.$fecha_pp[0];
		echo $concepto= utf8_decode(trim($linea[7]));echo "<br>";
		//echo $total= trim($linea[8]);echo "<br>";
		
		echo $total_d= trim($linea[8]);echo "<br>";
		echo $total=number_format($total_d,2, '.', '');
		
		echo $ejercicio= trim($linea[9]);echo "<br>";
		echo $cta_ff= trim($linea[12]);echo "<br>";
		echo $tipo_p= trim($linea[15]);echo "<br>";
		
		$cta=split(".",$cta_ff);
	 	$cuenta=$cta[2];
		
		echo $entidad=substr($cta_ff,0,3);
		
	
		
		if($entidad=='999' or $entidad=='309')
		   {
		     echo $cuenta=substr($cta_ff,6);
		   }
		  else
		   {
		     echo $cuenta=substr($cta_ff,7);
		   }
		
		
		 $sql = "select * from beneficiarios_aprobados where codigo_esidif='$beneficiario'";
	  	  
			if (!($r_bene= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf1";
			  echo $cuerpo1;
			  //...............................................
			} 
			$f_bene =  mysql_fetch_array($r_bene);
			
			 				  
				echo  $cuit=$f_bene['cuitl'];
				
			if ($fuente =='1.1')
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
				
				
				$sql = "delete from op_pendientes where Numero_OP='$orden_pago' and Ejercicio='$ejercicio'  ";
	  	  
					if (!($r_pendi= mysql_query($sql, $conexion_mysql)))
					{
					  //..informa del error producido...................
					  $cuerpo1  = "al buscar saf1";
					  echo $cuerpo1;
					  //...............................................
					} 
					$f_pendi =  mysql_fetch_array($r_pendi);
					
			 				  
				echo  $cuit=$f_pendi['cuitl'];
				
				
				 include('dgti-mysql-var_dbtgp.php');
	         include('dgti-intranet-mysql_connect.php');  
	         include('dgti-intranet-mysql_select_db.php');
			 
			 echo $clave=$ejercicio.''.$saf.''.$tipo.''.$nro_op;
			 
			 
			 
			  $ssql = "INSERT INTO `dbtgp`.`pagos_web` (`clave_OP`, `Ejercicio`, `SAF`, `FORMULARIO`, `NUMERO`, `FECHA_DE_PAGO`,`USU_PAGO`, `TIPO_PAGO`, `NUM_PAGO`, `id_escritural`, `IMP_PAGO`,  `CBU_DES`, `ESTADO`) VALUES ('$clave','$ejercicio','$saf','$tipo','$nro_op','$fecha','ESIDIF','$tipo_p','$lote','197','$total','3090000201001010060069','CONFIRMADO')";
 				 
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			} 

	  $ssql = "UPDATE `orden_pago` SET ESTADO='C',importe_a_pagar=0  WHERE `clave` = '$clave' and trim(importe_a_pagar)=trim('$total')";
 				 
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			} 
			
	$ssql = "UPDATE `orden_pago` SET ESTADO='C',importe_a_pagar=0  WHERE `clave` = '$clave' and trim(importe_a_pagar)=trim('$total')";
 				 
				  
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
		 
		 		
			
		echo "<br>";
				}
		else
		{
		if($entidad=='999')
		   {
			  if ($fuente !='1.1')
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
				
				
				$sql = "delete from op_pendientes where Numero_OP='$orden_pago' and Ejercicio='$ejercicio' and Saldos='$total' ";
	  	  
					if (!($r_pendi= mysql_query($sql, $conexion_mysql)))
					{
					  //..informa del error producido...................
					  $cuerpo1  = "al buscar saf1";
					  echo $cuerpo1;
					  //...............................................
					} 
					$f_pendi =  mysql_fetch_array($r_pendi);
					
			 				  
				echo  $cuit=$f_pendi['cuitl'];
				
				
				 include('dgti-mysql-var_dbtgp.php');
	         include('dgti-intranet-mysql_connect.php');  
	         include('dgti-intranet-mysql_select_db.php');
			 
			 echo $clave=$ejercicio.''.$saf.''.$tipo.''.$nro_op;
			 
			 
			 
			  $ssql = "INSERT INTO `dbtgp`.`pagos_web` (`clave_OP`, `Ejercicio`, `SAF`, `FORMULARIO`, `NUMERO`, `FECHA_DE_PAGO`,`USU_PAGO`, `TIPO_PAGO`, `NUM_PAGO`, `id_escritural`, `IMP_PAGO`,  `CBU_DES`, `ESTADO`) VALUES ('$clave','$ejercicio','$saf','$tipo','$nro_op','$fecha','ESIDIF','$tipo_p','$lote','197','$total','3090000201001010060069','CONFIRMADO')";
 				 
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			} 

	 $ssql = "UPDATE `orden_pago` SET ESTADO='C',importe_a_pagar=0  WHERE `clave` = '$clave' and trim(importe_a_pagar)=trim('$total')";
 				 
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			} 
			
	$ssql = "UPDATE `orden_pago` SET ESTADO='C',importe_a_pagar=0  WHERE `clave` = '$clave' and trim(importe_a_pagar)=trim('$total')";
 				 
				  
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
				
				
				
				
				}
				
		 }
		 else
		 {
			 include('dgti-mysql-var_dbtgp.php');
	         include('dgti-intranet-mysql_connect.php');  
	         include('dgti-intranet-mysql_select_db.php');
	 
	 
					  $ssql = "SELECT * 
				FROM  `escritural_ren` 
				WHERE  `CUENTA` ='$cuenta' and estado='A'";
								  
				 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
					  echo $cuerpo1;
					  //.....................................................................
					} 
					
					$f_pago =  mysql_fetch_array($r_pago);
					
			 				  
				echo  $escritural=trim($f_pago['ID_ESCRITURAL']);
			 
			 
				
				
				
	 
	echo $clave=$ejercicio.''.$saf.''.$tipo.''.$nro_op;

	 $ssql = "UPDATE `orden_pago` SET ESTADO='C',importe_a_pagar=0  WHERE `clave` = '$clave' and trim(importe_a_pagar)=trim('$total')";
 				 
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			} 
			
		$ssql = "UPDATE `orden_pago` SET ESTADO='C',importe_a_pagar=0  WHERE `clave` = '$clave' and trim(importe_a_pagar)=trim('$total')";
 				 
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			} 
	


        $ssql = "INSERT INTO `dbtgp`.`pagos_web` (`clave_OP`, `Ejercicio`, `SAF`, `FORMULARIO`, `NUMERO`, `FECHA_DE_PAGO`,`USU_PAGO`, `TIPO_PAGO`, `NUM_PAGO`, `id_escritural`, `IMP_PAGO`,  `CBU_DES`, `ESTADO`) VALUES ('$clave','$ejercicio','$saf','$tipo','$nro_op','$fecha','ESIDIF','$tipo_p','$lote','$escritural','$total','3090000201001010060069','CONFIRMADO')";
 				 
				  
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
	
	 $ssql = "INSERT INTO `orden_pago_fp` 
		        (`cuit` ,`saf`,`fuente`,`clase`,`orden_pago`,`fecha`,`concepto`,`importe`,`retencion`,
				 `ejercicio`,`total`,liquido,clave_escritural)
				VALUES ('$cuit','$saf','$fuente','$clase','$orden_pago','$fecha','$concepto','$importe',
						'$retencion','$ejercicio','$total','$liquido','$escritural'); ";
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
	}
	
	
	 $archivo = file("ret_pagado.txt");
  echo  $cuantos = count($archivo);
	
    for ($var=0;$var<$cuantos;$var++)
	{
				
	    $linea=  explode("\t",$archivo[$var]);
		
	
		
	 	
		 echo $ejercicio= trim($linea[2]);echo "<br>";
		 
		 echo $saf= trim($linea[0]);echo "<br>";
	
		 $tipo= trim($linea[3]);echo "<br>";
		 
		if(($tipo =='C41') or ($tipo=='C42'))
		  {
			$tipo=substr($tipo,1,3);   
		  }
		 
		 $nro_op= trim($linea[4]);
		echo $orden_pago=$tipo.'-'.$saf.'-'.$nro_op;echo "<br>";
		echo $fecha_p= trim($linea[1]);echo "<br>";
		
		$fecha_pp=split("/",$fecha_p);
	 	echo $fecha=$fecha_pp[2].'-'.$fecha_pp[1].'-'.$fecha_pp[0];echo "<br>";	
		
	
		
		echo $total_f= trim($linea[6]);echo "<br>";	
		echo $total=number_format($total_f,2, '.', '');
		
		echo $total_f1= trim($linea[5]);echo "<br>";	
		echo $total_b=number_format($total_f1,2, '.', '');
	
			 
			 
			 echo $clave=$ejercicio.''.$saf.''.$tipo.''.$nro_op;
		
		if($total> 0)	
		  { 


             include('dgti-mysql-var_dbtgp.php');
	         include('dgti-intranet-mysql_connect.php');  
	         include('dgti-intranet-mysql_select_db.php');
			 
			 
	 $ssql = "update `pagos_web` set  `IMP_PAGO_RET`='$total' where clave_OP='$clave' and `FECHA_DE_PAGO`='$fecha' ";
 				 
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			} 



		  }
	}
	exit;   
?>
	
<meta http-equiv='refresh' content='3;url=indextesoreria.php?sec=tesoreria/index1&apli=tgp&per=C'> 
	 
	<table width="60%" border="0" align="left">
     <tr>
     <td align="center">
     <center><h1>Guardando</h1></center>
	 <p class="Estilo2 style1 Estilo1"><img src="img/loader_guardando.gif" width="100" height="100" /></p>
      
      <p class="Estilo2 style1">
      <p>Sus datos fueron grabados con exito.</p></center>
	  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Espere unos segundos el Sistema se Redirigir&aacute; automaticamente
	  <br><br>
      Gracias
	  </font>
	  </p>
	  </td>
     </tr>
   </table>