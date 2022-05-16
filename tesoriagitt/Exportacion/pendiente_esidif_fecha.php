<?
//error_reporting ( E_ERROR );
    include('dgti-mysql-var_dbtgp.php');
	include('dgti-intranet-mysql_connect.php');  
	include('dgti-intranet-mysql_select_db.php');
	
    $archivo = file("pendiente_fecha.txt");
    $cuantos = count($archivo);
	
    for ($var=0;$var<$cuantos;$var++)
	{
				
	    $linea=  explode("\t",$archivo[$var]);
		
		echo $saf1= trim($linea[0]);echo "<br>";
		
		echo	$saf=ltrim(substr($saf1,4,6)); 
		
	   
		
		echo $tipo= trim($linea[1]);echo "<br>";
		
		
		
		if(($tipo =='C41') or ($tipo=='C42'))
		  {
			$tipo=substr($tipo,1,3);   
		  }
		
		
		 echo $ejercicio= trim($linea[2]);echo "<br>";
		 
		echo $nro_op= trim($linea[3]);
		
		
			echo $fecha_r=trim($linea[4]);echo "<br>";
		
			
		$fecha_rc=split("/",$fecha_r);
	 	echo $fecha_r=$fecha_rc[2].'-'.$fecha_rc[1].'-'.$fecha_rc[0];
		
		
		echo $fecha=trim($linea[5]);echo "<br>";
		
		echo $fecha_a=substr($fecha,0,10);echo "<br>";
		
		$fecha_ac=split("/",$fecha_a);
	 	echo $fecha_a=$fecha_ac[2].'-'.$fecha_ac[1].'-'.$fecha_ac[0];
		
		echo $orden_pago=$tipo.'-'.$saf.'-'.$nro_op;echo "<br>";
		
		
		echo $clave=$ejercicio.''.$saf.''.$tipo.''.$nro_op;
		
		
		 $ssql = "update `orden_pago` set FECHA_INGRESO='$fecha_a',FECHA_OP='$fecha_r'  WHERE `clave` = '$clave' and   (
`FECHA_INGRESO` IS NULL 
OR  `FECHA_INGRESO` =  '0000-00-00'
)  ";
 				 
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			 
			}		
			
			
			   
	   }
		 
	include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');
 
 $ssql = "SELECT *
                  FROM `orden_pago` 
                  WHERE estado !='C'
				   and orden_pago.id_escritural in ('158','159','160','161','162','163','164','165','166','167','168','169','170','171','172','173','174','175','176','177','178','179','180','181','182','183','184','185','186','187','188','189','190','191','192','193','194','195','197')";
				  
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
		 
		  $IMP_FORM_P=$fila['IMP_FORM'];
		  
		  $RETENCION=$fila['RETENCION'];
		  
		    $IMPORTE_A_PAGAR=$fila['IMPORTE_A_PAGAR'];
			 $IMP_DESAF=$fila['IMP_DESAF'];
		  
		 
		   $Imp_orden=$IMP_FORM_P-$RETENCION;
		 
		  // $total=$fila['IMP_PAGO'];
		  
		  $saldo=$fila['IMPORTE_A_PAGAR'];
		  
	
		  
		 // $saldo=$fila['IMPORTE_A_PAGAR'];
		  
		  $pagado=$IMP_FORM_P - $RETENCION - $IMPORTE_A_PAGAR+$IMP_DESAF;
		  
		  $fecha=$fila['FECHA_DE_PAGO'];
		  
		   $fecha_i=$fila['FECHA_INGRESO'];
		  
		  $N_eje=$fila['EJERCICIO'];
		  
		  
		   
		   $valor=$fila['ESTADO'];
		   
		     if ($valor=='P'){$valor='N';}
		  if ($valor=='B'){$valor='R';}
		  if ($valor=='A'){$valor='B';}
		  if ($valor=='I'){$valor='I';}
		   
		  // $TOTA_A_P=$importe-$retencion;
		   
	      
		  
		   $ssql = "INSERT INTO `op_pendientes`
		              ( `Ejercicio` , `Fecha_OP` , `Numero_OP` ,  `Saf` , `Fuente` ,
					   `Clase` , `Beneficiario` , `Concepto` ,total_orden, `Imp_orden` , `Total_Pagado` ,
					   `Saldos`,`cuit`,estado)
				   VALUES ('$N_eje' , '$fecha_i' , '$orden_pago' , '$saf' , '$fuente' ,
				      '$clase' , '$BENEFICIARIO' , '$concepto' , '$IMP_FORM_P' , '$Imp_orden','$pagado',
					  '$saldo','$cuit','$valor'); ";
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