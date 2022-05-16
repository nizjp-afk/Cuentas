<?
//error_reporting ( E_ERROR );
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
	
    $archivo = file("acumulado.txt");
  echo  $cuantos = count($archivo);
	
    for ($var=0;$var<$cuantos;$var++)
	{
				
	    $linea=  explode("\t",$archivo[$var]);
		
	   
		echo $saf= trim($linea[0]);echo "<br>";
		
		 echo $ejercicio= trim($linea[1]);echo "<br>";
		
		echo $tipo= trim($linea[2]);echo "<br>";
		
		if(($tipo =='C41') or ($tipo=='C42'))
		  {
			$tipo=substr($tipo,1,3);   
		  }
		
		
		echo $nro_op= trim($linea[3]);
		
		echo $orden_pago=$tipo.'-'.$saf.'-'.$nro_op;echo "<br>";
		
		
	    echo $nro_sidif= trim($linea[4]);echo "<br>";
		
		
		
		
		$sql = "select * from beneficiarios_aprobados where codigo_esidif='$nro_sidif'";
	  	  
			if (!($r_bene= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf1";
			  echo $cuerpo1;
			  //...............................................
			} 
			$f_bene =  mysql_fetch_array($r_bene);
			
			 				  
			echo  $cuit=$f_bene['cuitl'];
			
		
		
		echo $cod_ret= trim($linea[5]);echo "<br>";
		
		$sql = "select * from ret_esidif where codigo='$cod_ret'";
	  	  
			if (!($r_ret= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf1";
			  echo $cuerpo1;
			  //...............................................
			} 
			$f_ret =  mysql_fetch_array($r_ret);
			
			 				  
			echo  $retencion=$f_ret['nombre'];
		
		
		   echo $total_r= trim($linea[6]);echo "<br>";
		
	
		
		 $ssql = "SELECT * FROM `dd_retenciones`  WHERE ejercicio='$ejercicio' and orden = '$orden_pago' and dd_codigo='$cod_ret' and saf='$saf' ";
 				 
				  
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
							      
					 $ssql = "INSERT INTO dd_retenciones (`saf`, `ejercicio`, `orden`,  `dd_cuit`, `dd_nombre`, `dd_codigo`, `importe`) VALUES                                                         ('$saf','$ejercicio','$orden_pago','$cuit','$retencion','$cod_ret','$total_r'); ";
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
				 $ssql = "UPDATE dd_retenciones SET importe ='$total_r' 
				          WHERE `saf`='$saf' 
						  AND  `ejercicio`='$ejercicio'
						  AND `orden`='$orden_pago'
						  AND `dd_cuit`='$cuit'
						  AND `dd_codigo`='$cod_ret'; ";
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