<?
error_reporting ( E_ERROR );
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
    $archivo = file("pagado_esidif.txt");
    $cuantos = count($archivo);
    for ($var=0;$var<$cuantos;$var++)
	{
				
	    $linea=  explode(",",$archivo[$var]);
		echo $lote= $linea[11];
		if ($lote>1785)
		{
	    echo $beneficiario= $linea[0];
		echo $saf= $linea[1];
		echo $fuente= $linea[2];
		echo $clase= $linea[3];
		echo $tipo= $linea[4];
		if(($tipo =='C41') or ($tipo=='C42'))
		  {
			$tipo=substr($tipo,1,3);   
		  }
		 
		echo $nro_op= $linea[5];
		 $orden_pago=$tipo.'-'.$nro_op;
		echo $fecha= $linea[6];
		echo $concepto= $linea[7];
		echo $total= $linea[8];
		echo $ejercicio= $linea[9];
		
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
				
				 if($fuente=='1.1')
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
				
			
		echo "<br>";
		exit;	
		}
	}
	   
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