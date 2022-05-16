<?php
//error_reporting ( E_ERROR );
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
    $archivo = file("retencion.txt");
  echo  $cuantos = count($archivo);
 
	
    for ($var=0;$var<$cuantos;$var++)
	{
				
	    $linea=  explode("\t",$archivo[$var]);
		   
		echo $codigo= trim($linea[0]);echo '<br>';
		
		echo $saf= trim($linea[1]);echo '<br>';
		
		echo $fecha_p= trim($linea[2]);echo '<br>';
		
				
		 $tipo= trim($linea[3]);echo '<br>';
		if(($tipo =='C41') or ($tipo=='C42'))
		  {
			$tipo=substr($tipo,1,3);   
		  }
		 
		 $nro_op= trim($linea[4]);
		
		echo $orden_pago=$tipo.'-'.$saf.'-'.$nro_op;echo "<br>";
		
		$fecha_pp=split("/",$fecha_p);
	 	echo $fecha=$fecha_pp[2].'-'.$fecha_pp[1].'-'.$fecha_pp[0];
		
		
		echo $total_f1= trim($linea[5]);echo "<br>";
		echo $total_retencion=number_format($total_f1,2, '.', '');
		
		echo $op_saf= trim($linea[6]);echo "<br>";
		
		echo $ejercicio= trim($linea[7]);echo "<br>";
		
		echo $nro_es= trim($linea[8]);echo "<br>";
		
		
		
			$ssql = "SELECT * FROM `beneficiarios_aprobados` WHERE codigo_esidif='$nro_es'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_beneficiario= mysql_fetch_array ($r_beneficiario);
	 $fecha_aprobacion = $f_beneficiario['fecha_aprobacion']; 
	 $id_ganancia = $f_beneficiario['ganancia']; 
	 $ing_bruto = $f_beneficiario['ingreso']; 
	 $seguridad = $f_beneficiario['seguridad']; 
     $iva_situacion = $f_beneficiario['iva_situacion'];	  
	 $ganancia = $f_beneficiario['ganancia'];	  
		//  $alicuota = $f_beneficiario['alicuota'];	  
	 $ingreso = $f_beneficiario['ingreso'];
     $regimen = $f_beneficiario['regimen'];
	 $seguridad = $f_beneficiario['seguridad'];  
     $cuit=$f_beneficiario['cuitl'];
    
		
		
		 $ssql = "SELECT  * FROM regimen where id_regimen='$regimen'   ";
				 if (!($r_ib= mysql_query($ssql, $conexion_mysql)))
				{
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar tipo de iva";
				  echo $cuerpo1;
				  //.....................................................................
				} 	
				
	 $f_ib= mysql_fetch_array ($r_ib);
	 $alicuotaib = $f_ib['alicuota']; 
     $nosujetoib = $f_ib['base'];   
	


/////////////////////********************************/////////////////////////////////////////
		
		
		
		if(($codigo=='4') or ($codigo=='5'))
		{
		
		
		 $sql = "select * from sicore where orden='$orden_pago' and ejercicio='$ejercicio' and  saf='$saf' and fecha_io ='$fecha' ";
	  	  
			if (!($r_control= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf1";
			  echo $cuerpo1;
			  //...............................................
			} 
		
		   $cans=mysql_num_rows($r_control);
			
			 				  
			if($cans == 0)
			  {
				//echo 'hol'; echo '<br>';
			 
					 $ssql = "INSERT INTO `sicore` 
		        (`orden` ,`saf`,`ejercicio`,`monto`,`op_saf`,fecha_io)
				VALUES ('$orden_pago','$saf','$ejercicio','$total_retencion','$op_saf','$fecha'); ";
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
		
		
		if($codigo=='7')
		{
		
				
		 $sql = "select * from sicore_ib  where orden='$orden_pago' and ejercicio='$ejercicio' and  saf='$saf' and fecha_io ='$fecha'";
	  	  
			if (!($r_control= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf1";
			  echo $cuerpo1;
			  //...............................................
			} 
		
		   $cani=mysql_num_rows($r_control);
			
			 				  
			if(!($cani > 0))
			  {
				
			 
							 $ssql = "INSERT INTO `sicore_ib` 
						(`orden` ,`saf`,`ejercicio`,`monto`,`op_saf`,fecha_io,alicuota)
						VALUES ('$orden_pago','$saf','$ejercicio','$total_retencion','$op_saf','$fecha','$alicuotaib'); ";
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
		
		
		
		if(($codigo=='6') or ($codigo=='11') or ($codigo=='10') or ($codigo=='1'))
		{
		
		
		
		 $sql = "select * from sicore_ss  where orden='$orden_pago' and ejercicio='$ejercicio' and  saf='$saf' and fecha_io ='$fecha'";
	  	  
			if (!($r_control= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf1";
			  echo $cuerpo1;
			  //...............................................
			} 
		
		   $canss=mysql_num_rows($r_control);
			
			 				  
			if(!($canss > 0))
			  {
				
			 
					 $ssql = "INSERT INTO `sicore_ss` 
		        (`orden` ,`saf`,`ejercicio`,`monto`,`op_saf`,fecha_io)
				VALUES ('$orden_pago','$saf','$ejercicio','$total_retencion','$op_saf','$fecha'); ";
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
		
		
		
		
		$sql = "select * from ret_esidif where codigo='$codigo'";
	  	  
			if (!($r_ret= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf1";
			  echo $cuerpo1;
			  //...............................................
			} 
			$f_ret =  mysql_fetch_array($r_ret);
			
			 				  
			echo  $retencion=$f_ret['nombre'];
		
		
		
		
		
		
		
		 $ssql = "SELECT * FROM `dd_retenciones`  WHERE importe='$total_retencion' and ejercicio='$ejercicio' and orden = '$orden_pago' and dd_codigo='$codigo' and saf='$saf' ";
 				 
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			}		
			
			
		 $can1=mysql_num_rows($r_pago);
		 
		 
		 
		 if($can1 == 0)
			  {
							      
					 $ssql = "INSERT INTO dd_retenciones (`saf`, `ejercicio`, `orden`,  `dd_cuit`, `dd_nombre`, `dd_codigo`, `importe`) VALUES                                                         ('$saf','$ejercicio','$orden_pago','$cuit','$retencion','$codigo','$total_retencion'); ";
				 if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "retencion nueva para acumular ";
				  echo $cuerpo1;
				  echo $orden_pago;
				   echo $ejercicio;
				  //.....................................................................
				}
				
			  }
			else
			{
				 $ssql = "UPDATE dd_retenciones SET importe = importe +'$total_retencion' 
				          WHERE `saf`='$saf' 
						  AND  `ejercicio`='$ejercicio'
						  AND `orden`='$orden_pago'
						  AND `dd_cuit`='$cuit'
						  AND `dd_codigo`='$codigo'
						  AND importe='$total_retencion'; ";
				 if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "acumular retencion existente";
				  echo $cuerpo1;
				  echo $orden_pago;
				   echo $ejercicio;
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