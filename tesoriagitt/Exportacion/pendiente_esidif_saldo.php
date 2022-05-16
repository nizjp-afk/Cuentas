<?
//error_reporting ( E_ERROR );
    include('dgti-mysql-var_dbtgp.php');
	         include('dgti-intranet-mysql_connect.php');  
	         include('dgti-intranet-mysql_select_db.php');
	
    $archivo = file("pendiente_saldo.txt");
  echo  $cuantos = count($archivo);
    for ($var=0;$var<$cuantos;$var++)
	{
		
		 include('dgti-mysql-var_dbtgp.php');
	         include('dgti-intranet-mysql_connect.php');  
	         include('dgti-intranet-mysql_select_db.php');
	
				
	    $linea=  explode("\t",$archivo[$var]);
		
	    echo $ejercicio= trim($linea[2]);echo "<br>";
		
		//echo $saf= trim($linea[1]);echo "<br>";
		
		echo $saf1= trim($linea[0]);echo "<br>";
		
		echo	$saf=ltrim(substr($saf1,4,6)); 
		
		
		
		
		echo $tipo= trim($linea[1]);echo "<br>";
		
				
		echo $nro_op= trim($linea[4]);
		
		echo $orden_pago=$tipo.'-'.$saf.'-'.$nro_op;echo "<br>";
		
		echo $fuente= trim($linea[11]);echo "<br>";
		
		echo $fuente= str_replace('.','',$fuente);echo "<br>";
		
		echo $clase= trim($linea[12]);echo "<br>";
		
		
	    echo $nro_sidif= trim($linea[7]);echo "<br>";
		
		echo $fecha_r=trim($linea[14]);echo "<br>";
		
			
		$fecha_rc=split("/",$fecha_r);
	 	echo $fecha_r=$fecha_rc[2].'-'.$fecha_rc[1].'-'.$fecha_rc[0];
		
		echo $fecha=trim($linea[23]);echo "<br>";
		
		echo $fecha_a=substr($fecha,0,10);echo "<br>";
		
		$fecha_ac=split("/",$fecha_a);
	 	echo $fecha_a=$fecha_ac[2].'-'.$fecha_ac[1].'-'.$fecha_ac[0];
		
		
		
		
		
		$sql = "select * from beneficiarios_aprobados where codigo_esidif='$nro_sidif'";
	  	  
			if (!($r_bene= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar beneficiario";
			  echo $cuerpo1;
			  //...............................................
			} 
			$f_bene =  mysql_fetch_array($r_bene);
			
			 				  
			echo  $cuit=$f_bene['cuitl'];
			
		
			
			if($f_bene['razon_social']=='')
			     {
					
				   $beneficiario=$f_bene['apellido'].", ".$f_bene['nombre'];
				  }
				
			   else
			     {	  
		           $beneficiario=$f_bene['razon_social'];
				 }
		
		
		
		if($nro_sidif==5)
		{
			$cuit=5;
			$beneficiario='Vice-Presidencia Primera';
		}
		
		
		if($nro_sidif==330)
		{
			$cuit=330;
			
			$beneficiario='Direccion de Relaciones con Municipios';
		}
		
		if($nro_sidif==900)
		{
			$cuit=900;
			$beneficiario='Deuda Publica';
		}
		
		if($nro_sidif==4830)
		{
			$cuit=30714982970;
			$beneficiario='Subsecretaria De Transporte Transito Y Seguridad Vial';
		}
		
		
		
		
		echo $concepto= utf8_decode(trim($linea[25]));echo "<br>";
		
		echo $total_v= trim($linea[16]);echo "<br>";
		
		echo $total_f= trim($linea[15]);echo "<br>";
		
		echo $total_a_pagar= trim($linea[17]);echo "<br>";
		
		echo $cta_ff= trim($linea[20]);echo "<br>";
		
		$cta=split("-",$cta_ff);echo "<br>";
	 	
		echo $entidad=substr($cta_ff,0,3);echo "<br>";
		
	
		
		if($entidad=='999' or $entidad=='309')
		   {
		     echo $cuenta=substr($cta_ff,6);
		   }
		  else
		   {
		     echo $cuenta=substr($cta_ff,7);
		   }
		
		
	
		
		
		
		  
	
		
		if($total_v=='0.00')
		{
			$estado='A';
		}
		if($total_a_pagar == '0.00' and $total_v >0)
		{
			$estado='C';
		}
			if($total_a_pagar > 0 and $total_v > 0)
		{
			$estado='P';
		}
		
		if (!($entidad=='999'))
		  {
			
		  
		$ssql = "SELECT * 
				FROM  `escritural_ren` 
				WHERE  `CUENTA` ='$cuenta' and estado='A'";
								  
				 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar cuenta escritural";
					  echo $cuerpo1;
					  //.....................................................................
					} 
					
					$f_pago =  mysql_fetch_array($r_pago);
					
			 				  
				echo  $escritural=trim($f_pago['ID_ESCRITURAL']);
		
		  }
		  else
		  {
			  $escritural='197';
		  }
		echo $clave=$ejercicio.''.$saf.''.$tipo.''.$nro_op;
		
		
		 $ssql = "SELECT * FROM `orden_pago`  WHERE `clave` = '$clave' ";
 				 
				  
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
							      
				echo	 $ssql = "INSERT INTO `dbtgp`.`orden_pago` (`CLAVE`, `EJERCICIO`, `SAF`,  `FORMULARIO`, `NUMERO`, `FUENTE`, `CLASE`, `CUIT`, `BENEFICIARIO`, `CONCEPTO`, `IMP_FORM`,  `IMPORTE_A_PAGAR`,`ESTADO`, `id_escritural`,FECHA_INGRESO,FECHA_OP) VALUES ('$clave','$ejercicio','$saf','$tipo','$nro_op','$fuente','$clase','$cuit','$beneficiario','$concepto',
						'$total_f','$total_a_pagar','$estado','$escritural','$fecha_a','$fecha_r'); ";
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
				
						 		
			
		echo "<br>";
				}
				
		else
		 { 
			 $ssql = "UPDATE `orden_pago` SET  `EJERCICIO`='$ejercicio',
			                                     `SAF`='$saf',
												 `FORMULARIO`='$tipo',
											     `NUMERO`='$nro_op',
											     `FUENTE`='$fuente',
											     `CLASE`='$clase',
												 `CUIT`='$cuit',
												 `BENEFICIARIO`='$beneficiario',
												 `CONCEPTO`='$concepto',
												 `IMP_FORM`='$total_f', 
												 `IMPORTE_A_PAGAR`='$total_a_pagar',
												 `id_escritural`='$escritural',
												  ESTADO='$estado',
												  FECHA_INGRESO='$fecha_a',
												  FECHA_OP='$fecha_r' 
												  WHERE `clave` = '$clave' ";
 				 
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para modificar tgp";
			  echo $cuerpo1;
			  //.....................................................................
			} 
		 }
		 
		 
		
		include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
		
	
	 $sql = "update sicore_ib set bruto= '$total_f',neto= '$total_f' where orden='$orden_pago' and ejercicio='$ejercicio' and  saf='$saf'  ";
	  	  
			if (!($r_control= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf1";
			  echo $cuerpo1;
			  //...............................................
			} 
			
	 $sql = "update sicore_ss set neto= '$total_f' where orden='$orden_pago' and ejercicio='$ejercicio' and  saf='$saf'  ";
	  	  
			if (!($r_control= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf1";
			  echo $cuerpo1;
			  //...............................................
			} 		
	
		   
	/*if($total_a_pagar == '0' and $total_v >0)
	 {
	$sql = "delete from op_pendientes where Numero_OP='$orden_pago' and Ejercicio='$ejercicio' and saf='$saf' ";
	  	  
					if (!($r_pendi= mysql_query($sql, $conexion_mysql)))
					{
					  //..informa del error producido...................
					  $cuerpo1  = "al buscar saf1";
					  echo $cuerpo1;
					  //...............................................
					} 
					
	 }
	 */
	 
	
			
			
		/*
		
			if($total_a_pagar > 0 and $total_v > 0)
		{
			$sql = "update  op_pendientes set estado='$estado' where Numero_OP='$orden_pago' and Ejercicio='$ejercicio' and saf='$saf' ";
	  	  
					if (!($r_pendi= mysql_query($sql, $conexion_mysql)))
					{
					  //..informa del error producido...................
					  $cuerpo1  = "al buscar saf1";
					  echo $cuerpo1;
					  //...............................................
					} 
		}
		
		*/
		
		
		
		
		
		
		
		
		
		
		
	 include('dgti-mysql-var_dbtgp.php');
	         include('dgti-intranet-mysql_connect.php');  
	         include('dgti-intranet-mysql_select_db.php');
	 
	 	}
		

	include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');
 
 $ssql = "SELECT *
                  FROM `orden_pago` 
                  WHERE estado !='C'
				   and orden_pago.id_escritural in ('158','159','160','161','162','163','164','165','166','167','168','169','170','171','172','173','174','175','176','177','178','179','180','181','182','183','184','185','186','187','188','189','190','191','192','193','194','195','197')";
				  
     	 if (!($r_pago_p= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp para migrar a pendiente sigcom";
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

      while ($fila =  mysql_fetch_array($r_pago_p))
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
		  
		   $fecha_i=$fila['FECHA_OP'];
		  
		  $N_eje=$fila['EJERCICIO'];
		  
		   $valor=$fila['ESTADO'];
		   
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