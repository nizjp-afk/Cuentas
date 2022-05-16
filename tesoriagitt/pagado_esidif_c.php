<?
//error_reporting ( E_ERROR );
   
	
  /*  $archivo = file("pagado.txt");
  echo  $cuantos = count($archivo);
	
    for ($var=0;$var<$cuantos;$var++)
	{
				
	    $linea=  explode("\t",$archivo[$var]);
		echo $lote= trim($linea[9]);echo "<br>";
	
		if ($lote > '1784')
		{
	 	
		 echo $ejercicio= trim($linea[0]);echo "<br>";
		 echo $saf= trim($linea[1]);echo "<br>";
	
		 $tipo= trim($linea[2]);echo "<br>";
		if(($tipo =='C41') or ($tipo=='C42'))
		  {
			$tipo=substr($tipo,1,3);   
		  }
		 
		 $nro_op= trim($linea[3]);
		echo $orden_pago=$tipo.'-'.$saf.'-'.$nro_op;echo "<br>";
		echo $fecha_p= trim($linea[4]);echo "<br>";
		
		$fecha_pp=split("/",$fecha_p);
	 	echo $fecha=$fecha_pp[2].'-'.$fecha_pp[1].'-'.$fecha_pp[0];
		
		echo $tipo_p= trim($linea[5]);echo "<br>";
		
		echo $total= trim($linea[8]);echo "<br>";	
		
		echo $cta_ff= trim($linea[7]);echo "<br>";
		
				
		$cta=split(".",$cta_ff);
	 	echo $entidad=$cta[0];echo "<br>";
		echo $cuenta=$cta[2];echo "<br>";
		
		echo $entidad=substr($cta_ff,0,3);
		
		if($entidad=='999' or $entidad=='309')
		   {
		     echo $cuenta=substr($cta_ff,6);
		   }
		  else
		   {
		     echo $cuenta=substr($cta_ff,7);
		   }
		
					
				
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

	 $ssql = "INSERT INTO `dbtgp`.`pagos` (`clave_OP`, `Ejercicio`, `SAF`, `FORMULARIO`, `NUMERO`, `FECHA_DE_PAGO`,`USU_PAGO`, `TIPO_PAGO`, `NUM_PAGO`, `id_escritural`, `IMP_PAGO`,  `CBU_DES`, `ESTADO`) VALUES ('$clave','$ejercicio','$saf','$tipo','$nro_op','$fecha','ESIDIF','$tipo_p','$lote','$escritural','$total','3090000201001010060069','CONFIRMADO')";
 				 
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			} 

		
		 		
			
		echo "<br>";
				}
		
	}
*/


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
		
	
		
		echo $total= trim($linea[6]);echo "<br>";	
		
		echo $total_b= trim($linea[5]);echo "<br>";	
		
	
			 
			 
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



     $ssql = "update `pagos_orden` set  `RETENCION`=RETENCION+'$total' where clave_OP='$clave' ";
 				 
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			} 


		
		  }
			
		echo "<br>";
		
		
		
		include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
	
	 $sql = "update sicore_ib set bruto= '$total_b',neto= '$total_b' where orden='$orden_pago' and ejercicio='$ejercicio' and  saf='$saf'  ";
	  	  
			if (!($r_control= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf1";
			  echo $cuerpo1;
			  //...............................................
			} 
			
	 $sql = "update sicore_ss set neto= '$total_b' where orden='$orden_pago' and ejercicio='$ejercicio' and  saf='$saf'  ";
	  	  
			if (!($r_control= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf1";
			  echo $cuerpo1;
			  //...............................................
			} 		
	
		
		 include('dgti-mysql-var_dbtgp.php');
	         include('dgti-intranet-mysql_connect.php');  
	         include('dgti-intranet-mysql_select_db.php');
			
					
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